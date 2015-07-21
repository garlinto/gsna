<?php
/**
 * gsna/src/Entities/Messages.php
 */
namespace gsna\src\Entities;

/**
 * @Entity(repositoryClass="gsna\src\Repositories\MessagesRepository")
 * @Table(name="messages")
 * @HasLifecycleCallbacks
 */
class Messages
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="messages_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @ManyToOne(targetEntity="Topics", inversedBy="messages")
     * @JoinColumn(name="topic_id", referencedColumnName="id")
     **/
    private $topic;
    /**
     * @ManyToOne(targetEntity="SfDataFeeds", inversedBy="data")
     * @JoinColumn(name="feed_id", referencedColumnName="id")
     **/
    private $feed;
    /**
     * @Column(type="text", name="payload_char", nullable=true, options={"default":null})
     **/
    private $payloadChar;
    /**
     * @Column(type="integer", name="payload_int", nullable=true, options={"default":null})
     **/
    private $payloadInt;
    /**
     * @Column(type="decimal", precision=10, scale=3, name="payload_double", nullable=true, options={"default":null})
     **/
    private $payloadDouble;
    /**
     * @Column(type="boolean", nullable=true, name="payload_boolean", options={"default":null})
     **/
    private $payloadBoolean;
    /**
     * @Column(type="datetime", nullable=false)
     **/
    private $received;
    /**
     * @Column(type="boolean", nullable=false, name="pushed_to_cloud", options={"default":false})
     **/
    private $pushedToCloud;
    /**
     * @Column(type="integer", name="post_id", nullable=false)
     **/
    private $postId;
    
    /**
     * Set the correct data column
     **/
		public function setData($dataType, $data) {
			$dataIsPresentFlag = false;

			switch ($dataType) {
				case "payload_char":
					$this->setPayloadChar((string) $data);
					$dataIsPresentFlag = true;
					break;
				case "payload_int":
					$this->setPayloadInt((int) $data);
					$dataIsPresentFlag = true;
					break;
				case "payload_double":
					$this->setPayloadDouble((double) $data);
					$dataIsPresentFlag = true;
					break;
				case "payload_boolean":
					$this->setPayloadBoolean((boolean) $data);
					$dataIsPresentFlag = true;
					break;
			}			
			
			// no payload data, throw exception
			if (!$dataIsPresentFlag) {
				throw new \RuntimeException("Message payload was not found in published message");
			}
			
			return $this;
		}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set payloadChar
     *
     * @param string $payloadChar
     * @return Messages
     */
    public function setPayloadChar($payloadChar)
    {
    		if (!is_string($payloadChar)) {
    				$this->payloadChar = (string) $payloadChar;
    		} else {
    				$this->payloadChar = $payloadChar;
    		}
        return $this;
    }

    /**
     * Get payloadChar
     *
     * @return string 
     */
    public function getPayloadChar()
    {
        return $this->payloadChar;
    }

    /**
     * Set payloadInt
     *
     * @param integer $payloadInt
     * @return Messages
     */
    public function setPayloadInt($payloadInt)
    {
    		if (!is_int($payloadInt)) {
    				$this->payloadInt = (int) $payloadInt;
    		} else {
    				$this->payloadInt = $payloadInt;
    		}
       
       return $this;
    }

    /**
     * Get payloadInt
     *
     * @return integer 
     */
    public function getPayloadInt()
    {
        return $this->payloadInt;
    }

    /**
     * Set payloadDouble
     *
     * @param string $payloadDouble
     * @return Messages
     */
    public function setPayloadDouble($payloadDouble)
    {
        if (!is_float($payloadDouble)) {
    				$this->payloadDouble = (double) $payloadDouble;
    		} else {
    				$this->payloadDouble = $payloadDouble;
    		}
    		
       return $this;
    }

    /**
     * Get payloadDouble
     *
     * @return string 
     */
    public function getPayloadDouble()
    {
        return $this->payloadDouble;
    }

    /**
     * Set payloadBoolean
     *
     * @param boolean $payloadBoolean
     * @return Messages
     */
    public function setPayloadBoolean($payloadBoolean)
    {
    		if (!is_bool($payloadBoolean)) {
    				$this->payloadBoolean = (boolean) $payloadBoolean;
    		} else {
    				$this->payloadBoolean = $payloadBoolean;
    		}
        
        return $this;
    }

    /**
     * Get payloadBoolean
     *
     * @return boolean 
     */
    public function getPayloadBoolean()
    {
        return $this->payloadBoolean;
    }

		/**
     * Set received
     *
     * @param \DateTime $received
     * @return Messages
     */
    public function setReceived(\DateTime $received)
    {
        $this->received = $received;
        return $this;
    }		
		
    /**
     * Get received
     *
     * @return \DateTime 
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set pushedToCloud
     *
     * @param boolean $pushedToCloud
     * @return Messages
     */
    public function setPushedToCloud($pushedToCloud)
    {
        $this->pushedToCloud = $pushedToCloud;

        return $this;
    }

    /**
     * Get pushedToCloud
     *
     * @return boolean 
     */
    public function getPushedToCloud()
    {
        return $this->pushedToCloud;
    }
    
    /**
     * Set postId
     *
     * @param integer $postId
     * @return Messages
     */
    public function setPostId($postId)
    {
    		$this->postId = $postId;
    		
       return $this;
    }

    /**
     * Get postId
     *
     * @return integer 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set topic
     *
     * @param \gsna\src\Entities\Topics $topic
     * @return Messages
     */
    public function setTopic(\gsna\src\Entities\Topics $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \gsna\src\Entities\Topics 
     */
    public function getTopic()
    {
        return $this->topic;
    }
    
    /**
     * Set feed
     *
     * @param \gsna\src\Entities\SfDataFeeds $feed
     * @return Messages
     */
    public function setFeed(\gsna\src\Entities\SfDataFeeds $feed)
    {
        $this->feed = $feed;

        return $this;
    }

    /**
     * Get feed
     *
     * @return \gsna\src\Entities\SfDataFeeds 
     */
    public function getFeed()
    {
        return $this->feed;
    }
    
    /**
     * Get data by iterating through the payload columns until the one containing data is found
     *
     * @return	data
     */
    public function getData()
    {
    		if ($this->getPayloadChar()) {
    			return $this->getPayloadChar();
    		} elseif ($this->getPayloadInt()) {
    			return $this->getPayloadInt();
    		} elseif ($this->getPayloadDouble()) {
    			return $this->getPayloadDouble();
    		} elseif ($this->getPayloadBoolean()) {
    			return $this->getPayloadBoolean();
    		}
    		
    		return null;
    }
}
