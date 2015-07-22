<?php
/**
 * gsna/src/entities/Metrics.php
 */
namespace gsna\src\Entities;

/**
 * @Entity @Table(name="commands")
 **/
class Commands
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="SEQUENCE")
     * @SequenceGenerator(sequenceName="commands_id_seq", initialValue=1, allocationSize=1)
     **/
    private $id;
    /**
     * @Column(type="integer", nullable=false)
     **/
    private $topicId;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $type;
    /**
     * @Column(type="text", nullable=false)
     **/
    private $action;
    /**
     * @Column(type="text", nullable=true, options={"default":null})
     **/
    private $payload;
    /**
     * @Column(type="boolean", name="requires_response", nullable=false, options={"default":true})
     **/
    private $requiresResponse;
    /**
     * @Column(type="text", name="response_type", nullable=true, options={"default":null})
     **/
    private $responseType;
    /**
     * @Column(type="text", name="response_payload", nullable=true, options={"default":null})
     **/
    private $responsePayload;
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
     * Set topicId
     *
     * @param integer	$topicId
     * @return Commands
     */
    public function setTopicId($topicId)
    {
        $this->topicId = topicId;

        return $this;
    }

    /**
     * Get topicId
     *
     * @return integer 
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * Set type (the command type)
     *
     * @param string $type
     * @return Commands
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
     * Set action
     *
     * @param string $action
     * @return Commands
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set payload
     *
     * @param string $payload
     * @return Commands
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get payload
     *
     * @return string 
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set requires_response
     *
     * @param boolean	$requiresResponse
     * @return Commands
     */
    public function setRequiresResponse($req)
    {
        $this->requiresResponse = $req;

        return $this;
    }

    /**
     * Get requires_response
     *
     * @return boolean
     */
    public function getRequiresResponse()
    {
        return $this->requiresResponse;
    }
    
    /**
     * Set response_type
     *
     * @param string $responseType
     * @return Commands
     */
    public function setResponseType($rt)
    {
        $this->responseType = $rt;

        return $this;
    }

    /**
     * Get response_type
     *
     * @return string
     */
    public function getResponseType()
    {
        return $this->responseType;
    }
    
    /**
     * Set response_payload
     *
     * @param string $response_payload
     * @return Commands
     */
    public function setResponsePayload($rp)
    {
        $this->responsePayload = $rp;

        return $this;
    }

    /**
     * Get response_payload
     *
     * @return string
     */
    public function getResponsePayload()
    {
        return $this->responsePayload;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return Commands
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
     * @param boolean	$enabled
     * @return Commands
     */
    public function setEnabled($en)
    {
        $this->enabled = $en;

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