<?php
/**
 * gsna/src/Entities/SfDataFeeds.php
 *
 * Data feed information for data.sparkfun.com.
 * 	Links MQTT messages into groupings that together form the
 *	data needed by a particular data feed.
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="sf_data_feeds")
 **/
class SfDataFeeds
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="sf_data_feeds_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @OneToMany(targetEntity="Messages", mappedBy="feed")
     **/
    private $data;
    /**
     * @Column(type="text", name="public_key", nullable=false)
     **/
    private $publicKey;
    /**
     * @Column(type="text", name="private_key", nullable=false)
     **/
    private $privateKey;
    /**
     * @Column(type="text", name="delete_key", nullable=false)
     **/
    private $deleteKey;
    /**
     * @Column(type="integer", name="num_data_points", nullable=false)
     **/
    private $numDataPoints;
    /**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $description;
    /**
     * @Column(type="boolean", nullable=false, options={"default":true})
     **/
    private $enabled;
		/**
     * @Column(type="boolean", name="includes_timestamp_col", nullable=false, options={"default":true})
     **/
    private $includesTimestampCol;
    /**
     * $this->data contains all of the feed data associated with a sparkfun.com data feed
     **/
    public function __construct() {
        $this->data = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set publicKey
     *
     * @param string $publicKey
     * @return SfDataFeeds
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Get publicKey
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }
		
		/**
     * Set privateKey
     *
     * @param string $privateKey
     * @return SfDataFeeds
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Get privateKey
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }
    
    /**
     * Set deleteKey
     *
     * @param string $deleteKey
     * @return SfDataFeeds
     */
    public function setDeleteKey($deleteKey)
    {
        $this->deleteKey = $deleteKey;

        return $this;
    }

    /**
     * Get deleteKey
     *
     * @return string
     */
    public function getDeleteKey()
    {
        return $this->deleteKey;
    }
    
    /**
     * Set numDataPoints
     *
     * @param integer $numDataPoints
     * @return SfDataFeeds
     */
    public function setNumDataPoints($numDataPoints)
    {
        $this->numDataPoints = $numDataPoints;

        return $this;
    }

    /**
     * Get numDataPoints
     *
     * @return integer
     */
    public function getNumDataPoints()
    {
        return $this->numDataPoints;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return SfDataFeeds
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
     * @return SfDataFeeds
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
     * Set includesTimestampCol
     *
     * @param boolean $includesTimestampCol
     * @return SfDataFeeds
     */
    public function setIncludesTimestampCol($includesTimestampCol)
    {
        $this->includesTimestampCol = $includesTimestampCol;

        return $this;
    }
		
		/**
     * Get includesTimestampCol
     *
     * @return boolean 
     */
    public function getIncludesTimestampCol()
    {
        return $this->includesTimestampCol;
    }

    /**
     * Add data
     *
     * @param \gsna\src\Entities\Messages $data
     * @return SfDataFeeds
     */
    public function addFeedData(\gsna\src\Entities\Messages $data)
    {
        $this->data[] = $data;

        return $this;
    }

    /**
     * Remove data
     *
     * @param \gsna\src\Entities\Messages $data
     */
    public function removeTopic(\gsna\src\Entities\Messages $data)
    {
        $this->data->removeElement($data);
    }

    /**
     * Get data
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getData()
    {
        return $this->data;
    }
}
