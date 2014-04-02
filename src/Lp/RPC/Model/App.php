<?php
/**
 * LPApp
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_App
{
    /**
     * @var int $_id
     */
    protected $_id;

    /**
     * @var string $_name
     */
    protected $_name;

    /**
     * @var string $_authClientKey
     */
    protected $_authClientKey;

    /**
     * @var string $_authServerKey
     */
    protected $_authServerKey;


    /**
     * @param $id
     * @param $name
     * @param $authClientKey
     * @param $authServerKey
     */
    public function __construct ($id, $name, $authClientKey, $authServerKey)
    {
        $this->_id              = $id;
        $this->_name            = $name;
        $this->_authClientKey   = $authClientKey;
        $this->_authServerKey   = $authServerKey;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getAuthClientKey()
    {
        return $this->_authClientKey;
    }

    /**
     * @return string
     */
    public function getAuthServerKey()
    {
        return $this->_authServerKey;
    }

}
