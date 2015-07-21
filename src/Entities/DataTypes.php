<?php
/**
 * gsna/src/Entities/DataTypes.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="data_types")
 **/
class DataTypes
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="data_types_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @OneToMany(targetEntity="Topics", mappedBy="dataType")
     **/
    private $topics;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $type;
		/**
     * @Column(type="text", name="maps_to", nullable=false)
     **/
    private $mapsTo;
    /**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $description;
    
    /**
     * $this->topics contains all of the topics associated with a DataType.
     **/
    public function __construct() {
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
     * Set type
     *
     * @param string $type
     * @return DataTypes
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set mapsTo
     *
     * @param string $mapsTo
     * @return DataTypes
     */
    public function setMapsTo($mapsTo)
    {
        $this->mapsTo = $mapsTo;

        return $this;
    }

    /**
     * Get mapsTo
     *
     * @return string 
     */
    public function getMapsTo()
    {
        return $this->mapsTo;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return DataTypes
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
     * @return DataTypes
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
