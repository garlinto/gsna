<?php
/**
 * gsna/src/Entities/Subscriptions.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="subscriptions")
 **/
class Subscriptions
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="subscriptions_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @ManyToOne(targetEntity="Devices", inversedBy="subscriptions")
     * @JoinColumn(name="device_id", referencedColumnName="id")
     **/
    private $device;
    /**
     * @Column(name="topic_id")
		 * @ManyToOne(targetEntity="Topics")
     **/
    private $topic;
		/**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $description;
    /**
     * @Column(type="boolean", nullable=false, options={"default":true})
     **/
    private $enabled;

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
     * Set device
     *
     * @param string $device
     * @return Subscriptions
     */
    public function setDevice($device)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get device
     *
     * @return string 
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * Set topic
     *
     * @param string $topic
     * @return Subscriptions
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string 
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Subscriptions
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Subscriptions
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
}
