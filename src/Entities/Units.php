<?php
/** 
 * gsna/src/Entities/Units.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="units", uniqueConstraints={@UniqueConstraint(name="units_unit_key", columns={"unit"})})
 **/
class Units
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="units_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @OneToMany(targetEntity="Topics", mappedBy="unitOfMeasure")
     **/
    private $topics;
    /**
     * @ManyToOne(targetEntity="Metrics", inversedBy="units")
     * @JoinColumn(name="metric_id", referencedColumnName="id")
     **/
    private $metric;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $unit;
    /**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $description;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $abbr;
    
    /**
     * $this->topics contains all of the topics associated with a unit.
     **/
    public function __construct() {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->metrics = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set unit
     *
     * @param string $unit
     * @return Units
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Units
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
     * Set abbr
     *
     * @param string $abbr
     * @return Units
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string 
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Add topics
     *
     * @param \gsna\src\Entities\Topics $topics
     * @return Units
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
     * Set metric
     *
     * @param \gsna\src\Entities\Metrics $metric
     * @return Units
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
}
