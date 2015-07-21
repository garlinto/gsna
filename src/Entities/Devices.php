<?php
/**
 * gsna/src/Entities/Devices.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="devices")
 **/
class Devices
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="devices_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @OneToMany(targetEntity="Subscriptions", mappedBy="device")
     **/
    private $subscriptions;
    /**
     * @ManyToOne(targetEntity="DeviceClasses", inversedBy="devices")
		 * @JoinColumn(name="class_id", referencedColumnName="id")
     **/
    private $class;
    /**
     * @ManyToOne(targetEntity="Devices", inversedBy="project")
     * @JoinColumn(name="group_id", referencedColumnName="id")
     **/
    private $devices;
		/**
     * @OneToMany(targetEntity="Devices", mappedBy="devices")
     **/
    private $project;
    /**
     * @OneToMany(targetEntity="Topics", mappedBy="device")
     **/
    private $topics;
		/**
     * @Column(type="text", nullable=false)
     **/
    private $name;
    /**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $description;
    
    /**
     * $this->project contains all of the devices associated with a parent device.
     **/
    public function __construct() {
        $this->devices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subscriptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Devices
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Devices
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
     * Add subscriptions
     *
     * @param \gsna\src\Entities\Subscriptions $subscriptions
     * @return Devices
     */
    public function addSubscription(\gsna\src\Entities\Subscriptions $subscriptions)
    {
        $this->subscriptions[] = $subscriptions;

        return $this;
    }

    /**
     * Remove subscriptions
     *
     * @param \gsna\src\Entities\Subscriptions $subscriptions
     */
    public function removeSubscription(\gsna\src\Entities\Subscriptions $subscriptions)
    {
        $this->subscriptions->removeElement($subscriptions);
    }

    /**
     * Get subscriptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * Set class
     *
     * @param \gsna\src\Entities\DeviceClasses $class
     * @return Devices
     */
    public function setClass(\gsna\src\Entities\DeviceClasses $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \gsna\src\Entities\DeviceClasses 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set devices
     *
     * @param \gsna\src\Entities\Devices $devices
     * @return Devices
     */
    public function setDevices(\gsna\src\Entities\Devices $devices = null)
    {
        $this->devices = $devices;

        return $this;
    }

    /**
     * Get devices
     *
     * @return \gsna\src\Entities\Devices 
     */
    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * Add project
     *
     * @param \gsna\src\Entities\Devices $project
     * @return Devices
     */
    public function addProject(\gsna\src\Entities\Devices $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \gsna\src\Entities\Devices $project
     */
    public function removeProject(\gsna\src\Entities\Devices $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Get project
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Add topics
     *
     * @param \gsna\src\Entities\Topics $topics
     * @return Devices
     */
    public function addTopic(\gsna\src\Entities\Topics $topics)
    {
        $this->topics[] = $topics;

        return $this;
    }

    /**
     * Remove topics
     *
     * @param \gsna\src\Entities\Topics $topics
     */
    public function removeTopic(\gsna\src\Entities\Topics $topics)
    {
        $this->topics->removeElement($topics);
    }

    /**
     * Get topics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTopics()
    {
        return $this->topics;
    }
}
