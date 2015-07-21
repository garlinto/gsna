<?php
/**
 * gsna/src/Entities/DeviceClasses.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="device_classes")
 **/
class DeviceClasses
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="device_classes_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
     /**
     * @OneToMany(targetEntity="Devices", mappedBy="class")
     **/
    private $devices;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $name;
		/**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $description;
    
    /**
     * $this->devices contains all of the devices associated with a Device Class.
     **/
    public function __construct() {
        $this->devices = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return DeviceClasses
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
     * @return DeviceClasses
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
     * Add devices
     *
     * @param \gsna\src\Entities\Devices $devices
     * @return DeviceClasses
     */
    public function addDevice(\gsna\src\Entities\Devices $devices)
    {
        $this->devices[] = $devices;

        return $this;
    }

    /**
     * Remove devices
     *
     * @param \gsna\src\Entities\Devices $devices
     */
    public function removeDevice(\gsna\src\Entities\Devices $devices)
    {
        $this->devices->removeElement($devices);
    }

    /**
     * Get devices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDevices()
    {
        return $this->devices;
    }
}
