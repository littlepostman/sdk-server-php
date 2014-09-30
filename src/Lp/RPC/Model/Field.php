<?php

class Lp_RPC_Model_Field
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $descriptiveName;

    /**
     * @var bool
     */
    protected $tagBased;


    /**
     * @param string $name
     * @param string $descriptiveName
     * @param bool   $tagBased
     */
    public function __construct($name, $descriptiveName, $tagBased = false)
    {
        $this->name            = $name;
        $this->descriptiveName = $descriptiveName;
        $this->tagBased        = $tagBased;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescriptiveName()
    {
        return $this->descriptiveName;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $descriptiveName
     */
    public function setDescriptiveName($descriptiveName)
    {
        $this->descriptiveName = $descriptiveName;
    }

    /**
     * @return boolean
     */
    public function getTagBased()
    {
        return $this->tagBased;
    }

    /**
     * @param boolean $tagBased
     */
    public function setTagBased($tagBased)
    {
        $this->tagBased = $tagBased;
    }
}
