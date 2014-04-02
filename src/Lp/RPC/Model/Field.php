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
     * @param string $name
     * @param string $descriptiveName
     */
    public function __construct ($name, $descriptiveName)
    {
        $this->name            = $name;
        $this->descriptiveName = $descriptiveName;
    }

    /**
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescriptiveName ()
    {
        return $this->descriptiveName;
    }

    /**
     * @param string $name
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $descriptiveName
     */
    public function setDescriptiveName ($descriptiveName)
    {
        $this->descriptiveName = $descriptiveName;
    }

}
