<?php
/**
 * @class MQTTClient
 * @author Nathan Garlington
 * @date 2015-06-19
 * @description Consumes the Mosquitto-PHP php module (alpha release)
 * 	written by mgdm, https://github.com/mgdm/Mosquitto-PHP.
 *	This class is based on code for the subclassed example.
 *
 **/
namespace gsna\mqtt;

use gsna\src\Entities\Topics as Topic,
		gsna\src\Entities\Messages as Message,
		gsna\mqtt\MessageHandler as MessageHandler,
		Doctrine\Common\Util\Debug as Debug;

class Client extends \Mosquitto\Client {
	
	const SF_DATA_URI = 'https://data.sparkfun.com';
	const SF_DATA_ACTION = 'input';
	
	private $_em; // Doctrine2 ORM entity manager instance
	protected $pendingSubs = [];
	protected $grantedSubs = [];

	public function __construct(\Doctrine\ORM\EntityManager $entityManager, $id = null, $cleanSession = false) {
		
		$this->_em = $entityManager;
		
		parent::__construct($id, $cleanSession);
		parent::onSubscribe(array($this, 'subscribeHandler'));
		parent::onMessage(array($this, 'messageHandler'));
	}
	
	public function subscribeHandler($mid, $qosCount, $grantedQos) {
		// if we are not subscribed to an incoming message on $topic, return 
		if (!isset($this->pendingSubs[$mid])) {
			return;
		}
		
		// we are subscribed
		$topic = $this->pendingSubs[$mid];
		$this->grantedSubs[$topic] = $grantedQos;
		echo "Subscribed to topic '{$topic}' with message ID {$mid}\n";
	}

	public function messageHandler(\Mosquitto\Message $message)	{
		
		$mh = new MessageHandler($message, $this->_em);
		
		echo "Message received. Processing...";
		if ($mh->process()) {
			echo "[OK]\n";
		} else {
			echo "[failed]\n";
		}
		
		echo "Assert uploadable...";
		if ($mh->assertUploadable()) {
				echo "[Yes] -> Pushing data to data.sparkfun.com...";
				if ($mh->pushToCloud()) {
					echo "[OK]\n";
				} else {
					echo "[failed]\n";
				}
		} else {
			echo "[no] -> more data required\n";
		}
		
		echo "***************************\n\n";
}				
	
	public function subscribe($topic, $qos) {
		$mid = parent::subscribe($topic, $qos);
		$this->pendingSubs[$mid] = $topic;
	}
	
	public function getSubscriptions() {
		return $this->grantedSubs;
	}

}
