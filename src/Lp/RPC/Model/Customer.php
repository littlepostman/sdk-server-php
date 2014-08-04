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
     * @var string
     */
    private $_email;

    /**
     * @var string
     */
    private $_contactPerson;

    /**
     * @var string
     */
    private $_language;

    /**
     * @var string
     */
    private $_password;


    /**
     * @param string $name
     * @param string $logoUrl
     * @param array  $apps
     */
    public function __construct(
        $name,
        $logoUrl,
        $apps,
        $email = '',
        $contactPerson = '',
        $language = '',
        $password = ''
    )
    {
        $this->_name    = $name;
        $this->_logoUrl = $logoUrl;
        $this->_apps    = $apps;

        $this->_email = $email;
        $this->_contactPerson = $contactPerson;
        $this->_language = $language;
        $this->_password = $password;
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
    public function getLogoUrl()
    {
        return $this->_logoUrl;
    }

    /**
     * @return array
     */
    public function getApps()
    {
        return $this->_apps;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->_language;
    }

    /**
     * @return string
     */
    public function getContactPerson()
    {
        return $this->_contactPerson;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }
}
