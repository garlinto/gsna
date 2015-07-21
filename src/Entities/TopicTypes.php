<?php
/**
 * gsna/src/Entities/sTopicTypes.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="topic_types")
 **/
class TopicTypes
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="topic_types_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @Column(type="boolean", nullable=false, options={"default":true})
     **/
    private $enabled;
    /**
     * @OneToMany(targetEntity="Topics", mappedBy="type")
     **/
    private $topics;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $name;
		/**
     * @Column(type="text", nullable=false)
     **/
    private $description;
    
    /**
     * $this->topics contains all of the topics associated with a Topic Type
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return TopicTypes
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
     * Set name
     *
     * @param string $name
     * @return TopicTypes
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
     * @return TopicTypes
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
     * @return TopicTypes
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
