<?php
/**
 * gsna/src/entities/Metrics.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="metrics")
 **/
class Metrics
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="metrics_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @OneToMany(targetEntity="Topics", mappedBy="metric")
     **/
    private $topics;
    /**
     * @OneToMany(targetEntity="Units", mappedBy="metric")
     **/
    private $units;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $metric;
		/**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $description;
    
    /**
     * $this->topics contains all of the topics associated with a metric.
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
     * Set metric
     *
     * @param string $metric
     * @return Metrics
     */
    public function setMetric($metric)
    {
        $this->metric = $metric;

        return $this;
    }

    /**
     * Get metric
     *
     * @return string 
     */
    public function getMetric()
    {
        return $this->metric;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Metrics
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
     * @return Metrics
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
     * Add units
     *
     * @param \gsna\src\Entities\Units $units
     * @return Metrics
     */
    public function addUnit(\gsna\src\Entities\Units $units)
    {
        $this->units[] = $units;

        return $this;
    }

    /**
     * Remove units
     *
     * @param \gsna\src\Entities\Units $units
     */
    public function removeUnit(\gsna\src\Entities\Units $units)
    {
        $this->units->removeElement($units);
    }

    /**
     * Get units
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnits()
    {
        return $this->units;
    }
}
