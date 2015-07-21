<?php
/**
 * gsna/src/Entities/Locations.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="locations")
 **/
class Locations
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="locations_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @OneToMany(targetEntity="Topics", mappedBy="location")
     **/
    private $topics;
    /**
     * @OneToMany(targetEntity="Locations", mappedBy="sector")
     **/
    private $path;
    /**
     * @ManyToOne(targetEntity="Locations", inversedBy="path")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    private $sector;
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
        $this->path = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Locations
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
     * @return Locations
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
     * Add topics
     *
     * @param \gsna\src\Entities\Topics $topics
     * @return Locations
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

    /**
     * Add path
     *
     * @param \gsna\src\Entities\Locations $path
     * @return Locations
     */
    public function addPath(\gsna\src\Entities\Locations $path)
    {
        $this->path[] = $path;

        return $this;
    }

    /**
     * Remove path
     *
     * @param \gsna\src\Entities\Locations $path
     */
    public function removePath(\gsna\src\Entities\Locations $path)
    {
        $this->path->removeElement($path);
    }

    /**
     * Get path
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set sector
     *
     * @param \gsna\src\Entities\Locations $sector
     * @return Locations
     */
    public function setSector(\gsna\src\Entities\Locations $sector = null)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return \gsna\src\Entities\Locations 
     */
    public function getSector()
    {
        return $this->sector;
    }
}
