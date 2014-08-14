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
     * @var string
     */
    protected $_contactEmail;

    /**
     * @var string $_authClientKey
     */
    protected $_authClientKey;

    /**
     * @var string $_authServerKey
     */
    protected $_authServerKey;


    /**
     * @param int    $id
     * @param string $name
     * @param string $authClientKey
     * @param string $authServerKey
     */
    public function __construct($id, $name, $authClientKey, $authServerKey)
    {
        if (empty($name) || !is_string($name)) {
            throw new \Exception('Invalid app name');
        }

        $this->_id            = $id;
        $this->_name          = $name;
        $this->_authClientKey = $authClientKey;
        $this->_authServerKey = $authServerKey;
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

    /**
     * @param string $contactEmail
     */
    public function setContactEmail($contactEmail)
    {
        $this->_contactEmail = $contactEmail;
    }

    /**
     * @return string
     */
    public function getContactEmail()
    {
        return $this->_contactEmail;
    }
}
