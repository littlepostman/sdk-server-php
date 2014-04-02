<?php

/**
 * LPCustomer
 */
class Lp_RPC_Model_Customer
{

    /**
     * @var string
     */
    protected $_name;

    /**
     * @var string
     */
    protected $_logoUrl;

    /**
     * @var array
     */
    protected $_apps;

    /**
     * @param string $name
     * @param string $logoUrl
     * @param array  $apps
     */
    public function __construct ($name, $logoUrl, $apps)
    {
        $this->_name    = $name;
        $this->_logoUrl = $logoUrl;
        $this->_apps    = $apps;
    }

    /**
     * @return string
     */
    public function getName ()
    {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getLogoUrl ()
    {
        return $this->_logoUrl;
    }

    /**
     * @return array
     */
    public function getApps ()
    {
        return $this->_apps;
    }

}
