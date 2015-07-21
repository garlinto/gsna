<?php
/**
 * gsna\mqtt\MessageHandler.php
 *
 * Process messages received from MQTT broker
 *	- validate messages
 *	- database management
 *	- push data to cloud
 *
 * @date	2015-07-14
 */
namespace gsna\mqtt;

use gsna\src\Entities\SfDataFeeds,
		gsna\src\Entities\Messages as Message,
		gsna\src\Entities\Topics,
		gsna\GSNAException as GSNAException,
		Doctrine\Common\Util\Debug as Debug;

class MessageHandler
{
	protected $topic								= null;
	protected $payload							= null;
	protected $em										= null;
	protected $topidId							= null;
	protected $postId							= null;
	protected $feedId							= null;
	protected $sfDataFeed					= null;
	protected $messageId						= null;
	protected $messagesRepository = null;
	protected $gsnaMessages				= null;
	
	public function __construct(\Mosquitto\Message $message, \Doctrine\ORM\EntityManager $entityManager) {
		
		$this->topic = $message->topic;
		$this->payload = $message->payload;
		$this->em = $entityManager;
		$this->messagesRepository = $this->em->getRepository('gsna\src\Entities\Messages');
		$this->_parseTopic($this->topic);
	}
	
	/**
	 * Parse the received topic
	 * Messages will be received in the form of:
	 *
	 *	topic_id/1/post_id/32123/[feed_id/43]
	 *
	 * The feed_id	is optional, only necessary if message payload will be pushed to data.sparkfun.com
	 *
	 * @param		string	$topic
	 * @return	void
	 * @scope		private
	 */
	private function _parseTopic($topic) {
		
		$parts = explode('/', $this->topic);
		$this->topicId	= $parts[1];
		$this->postId		= $parts[3];
		
		if (6 == count($parts)) {
			$this->feedId = $parts[5];
		}
		
	}
	
	/**
	 * Dump message object
	 *
	 * @param		void
	 * @return	void
	 * @scope		public
	 */
	public function dump() {
		echo "Received message: [ {$this->topic} {$this->payload} ]\n";
		echo "Parsed data:\n\ttopicId: {$this->topicId}\n";
		echo "\tpostId: {$this->postId}\n";
		echo "\tfeedId: {$this->feedId}\n";
		echo "\tpayload: '{$this->payload}'\n";
	}
	/**
	 * Save the received message by inserting it into the database
	 *
	 * @param		void
	 * @return	boolean
	 * @scope		public
	 */
	public function process() {
		try {
			// look up topic by id			
			$topic = $this->em->find('gsna\src\Entities\Topics', $this->topicId);
			if (empty($topic)) {
				throw new GSNAException("Topic with id '{$this->topicId}' was not found in db.", GSNAException::RECORD_NOT_FOUND);
			}
			
			// create a new gsna\src\Entities\Messages instance
			$msg = new Message;
			
			// get the data_type for this topic
			$dataType = $topic->getDataType();
			
			// get the feed Id record and pass the entity instance to the $msg object
			if (!empty($this->feedId)) {
				$this->sfDataFeed = $this->em->find('gsna\src\Entities\SfDataFeeds', $this->feedId);
				if (empty($this->sfDataFeed)) {
					throw new GSNAException("SfDataFeed with id '" . $this->feedId . "' was not found in db", GSNAException::RECORD_NOT_FOUND);
				}
			}
			
			$msg
				->setData($dataType->getMapsTo(), $this->payload)
				->setReceived(new \DateTime("now"))
				->setTopic($topic)
				->setPostId($this->postId)
				->setFeed($this->sfDataFeed)
				->setPushedToCloud(false);
			
			// persist and commit
			$this->em->persist($msg);
			$this->em->flush();

			return true;
		} catch (GSNAException $e) {
			echo $e;
			return false;
		}
	} // end MessageHandler::process()

	/**
	 * Check to verify that all data points are available
	 *	for a given sparkfun datafeed before pushing to the cloud
	 *
	 * @param		void
	 * @return	boolean
	 * @scope		public
	 */
	public function assertUploadable() {
		try {
		
			$this->gsnaMessages = $this->messagesRepository->getMessagesToPost($this->postId);
			
			if ($this->gsnaMessages) {
				
				// count number of messages with this postId				
				$numMsgs = count($this->gsnaMessages);
				
				// rather than query the db again for the sparfun datafeed record,
				// use the one that was created in the process() method
				if (!empty($this->sfDataFeed)) {
					$numDataPoints = $this->sfDataFeed->getNumDataPoints();
					
					// does the number of required datapoints include a timestamp column?
					$dateIsDataPoint = $this->sfDataFeed->getIncludesTimestampCol();

					// if the timestamp column (which would be set automatically)
					// is part of the dataset, we can subtract it from the number
					// of required datapoints.
					if (true == $dateIsDataPoint) {
						$requiredNumDataPoints = $numDataPoints - 1;
					}
					
					// if the requred number of datapoints is equal to the number
					// of posts with this postId, then we can push to cloud
					if ($numMsgs == $requiredNumDataPoints) {
						return true;
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
		} catch (\Exception $e) {
			echo "Caught Exception\n\t", $e->getMessage();
			return false;
		}
	}
	
	/**
	 * Upload message payload to data.sparkfun.com
	 *
	 * @param		void
	 * @return	boolean
	 * @scope		public
	 */
	public function pushToCloud() {
		
		try {
			// extract data point from each unique message
			$postData = array();			
			
			$includesTimestampCol = $this->sfDataFeed->getIncludesTimestampCol();
			
			foreach ($this->gsnaMessages as $msg) {
				// get the topic from the message record
				$topic = $msg->getTopic();
				// next, get the metric the topic publishes
				$metric = $topic->getMetric();
				// next, get the datatype that used to record the metric
				$dataType = $topic->getDataType();
				// finally add the data point to the metric
				$postData[$metric->getMetric()] = $msg->getData();
				$timestamp = $msg->getReceived()->format('Y-m-d H:i:s');
			}
			
			$includesTimestampCol = $this->sfDataFeed->getIncludesTimestampCol();
			if ($includesTimestampCol) {
				$postData["timestamp"] = $timestamp;
			}

			// TODO - add check for number of postData elements compared to
			// number of required datapoints. Not worrying about it just yet.

			$curl = curl_init();
		 	 
		  $header[] = "Phant-Private-Key: " . $this->sfDataFeed->getPrivateKey();
		
		  curl_setopt($curl, CURLOPT_URL, "https://data.sparkfun.com/input/" . $this->sfDataFeed->getPublicKey()); 
		  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		  curl_setopt($curl, CURLOPT_POST, true);
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		
		  $response = curl_exec($curl); // execute the curl command 
		  if (0 == curl_errno($curl)) {
		  	foreach ($this->gsnaMessages as $msg) {
			  	$msg->setPushedToCloud(true);
			  	$this->em->persist($msg);
			  }
			  $this->em->flush();
			  return true;
		  } else {
		  	throw new GSNAException("Upload failed", GSNAException::GSNA_UPLOAD_TO_SF_FAILED);
		  }
		  curl_close($curl); // close the connection
		  
		 } catch (\Exception $e) {
			echo "Error pushing data to sparkfun:\n\t{$e->getLine}\n\t{$e->getMessage()}\n";
			return false;
		}
	}
	
}