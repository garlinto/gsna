<?php
/**
 * gsna/src/Entities/Topics.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="topics")
 **/
class Topics
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="topics_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @OneToMany(targetEntity="Messages", mappedBy="topic")
     **/
    private $messages;
    /**
     * @Column(type="boolean", nullable=false)
     **/
    private $enabled;
    /**
     * @ManyToOne(targetEntity="Locations", inversedBy="topics")
     * @JoinColumn(name="location_id", referencedColumnName="id")
     **/
    private $location;
    /**
     * @ManyToOne(targetEntity="TopicTypes", inversedBy="topics")
     * @JoinColumn(name="type_id", referencedColumnName="id")
     **/
    private $type;
    /**
     * @ManyToOne(targetEntity="DataTypes", inversedBy="topics")
     * @JoinColumn(name="data_type_id", referencedColumnName="id")
     **/
    private $dataType;
    /**
     * @ManyToOne(targetEntity="Devices", inversedBy="topics")
     * @JoinColumn(name="device_id", referencedColumnName="id")
     **/
    private $device;
    /**
     * @ManyToOne(targetEntity="Metrics", inversedBy="topics")
     * @JoinColumn(name="metric_id", referencedColumnName="id")
     **/
    private $metric;
    /**
     * @ManyToOne(targetEntity="Units", inversedBy="topics")
     * @JoinColumn(name="unit_id", referencedColumnName="id")
     **/
    private $unitOfMeasure;
    /**
     * @Column(type="integer", nullable=false, options={"default":2})
     **/
    private $qos;
    /**
     * @Column(type="boolean", nullable=false, name="push_to_cloud", options={"default":false})
     **/
    private $pushToCloud;
    /**
     * @Column(type="datetime", nullable=false)
     **/
    private $created;
    /**
     * @Column(type="datetime", nullable=true, options={"default":null})
     **/
    private $updated;
		
		/**
     * $this->messages contains all of the messages associated with a topic.
     **/
    public function __construct() {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Topics
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set qos
     *
     * @param integer $qos
     * @return Topics
     */
    public function setQos($qos)
    {
        $this->qos = $qos;

        return $this;
    }

    /**
     * Get qos
     *
     * @return integer 
     */
    public function getQos()
    {
        return $this->qos;
    }

    /**
     * Set pushToCloud
     *
     * @param boolean $pushToCloud
     * @return Topics
     */
    public function setPushToCloud($pushToCloud)
    {
        $this->pushToCloud = $pushToCloud;

        return $this;
    }

    /**
     * Get pushToCloud
     *
     * @return boolean 
     */
    public function getPushToCloud()
    {
        return $this->pushToCloud;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Topics
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Topics
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add messages
     *
     * @param \gsna\src\Entities\Messages $messages
     * @return Topics
     */
    public function addMessage(\gsna\src\Entities\Messages $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \gsna\src\Entities\Messages $messages
     */
    public function removeMessage(\gsna\src\Entities\Messages $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set location
     *
     * @param \gsna\src\Entities\Locations $location
     * @return Topics
     */
    public function setLocation(\gsna\src\Entities\Locations $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \gsna\src\Entities\Locations 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set type
     *
     * @param \gsna\src\Entities\TopicTypes $type
     * @return Topics
     */
    public function setType(\gsna\src\Entities\TopicTypes $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \gsna\src\Entities\TopicTypes 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dataType
     *
     * @param \gsna\src\Entities\DataTypes $dataType
     * @return Topics
     */
    public function setDataType(\gsna\src\Entities\DataTypes $dataType = null)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * Get dataType
     *
     * @return \gsna\src\Entities\DataTypes 
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set device
     *
     * @param \gsna\src\Entities\Devices $device
     * @return Topics
     */
    public function setDevice(\gsna\src\Entities\Devices $device = null)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get device
     *
     * @return \gsna\src\Entities\Devices 
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * Set metric
     *
     * @param \gsna\src\Entities\Metrics $metric
     * @return Topics
     */
    public function setMetric(\gsna\src\Entities\Metrics $metric = null)
    {
        $this->metric = $metric;

        return $this;
    }

    /**
     * Get metric
     *
     * @return \gsna\src\Entities\Metrics 
     */
    public function getMetric()
    {
        return $this->metric;
    }

    /**
     * Set unitOfMeasure
     *
     * @param \gsna\src\Entities\Units $unitOfMeasure
     * @return Topics
     */
    public function setUnitOfMeasure(\gsna\src\Entities\Units $unitOfMeasure = null)
    {
        $this->unitOfMeasure = $unitOfMeasure;

        return $this;
    }

    /**
     * Get unitOfMeasure
     *
     * @return \gsna\src\Entities\Units 
     */
    public function getUnitOfMeasure()
    {
        return $this->unitOfMeasure;
    }
}
