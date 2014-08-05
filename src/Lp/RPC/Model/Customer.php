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
    private $_contactPersonTitle;

    /**
     * @var string
     */
    private $_contactPersonFirstName;

    /**
     * @var string
     */
    private $_contactPersonLastName;

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
        $apps
    )
    {
        $this->_name    = $name;
        $this->_logoUrl = $logoUrl;
        $this->_apps    = $apps;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->_logoUrl;
    }

    /**
     * @param string $logoUrl
     */
    public function setLogoUrl($logoUrl)
    {
        $this->_logoUrl = $logoUrl;
    }

    /**
     * @return array
     */
    public function getApps()
    {
        return $this->_apps;
    }

    /**
     * @param array $apps
     */
    public function setApps($apps)
    {
        $this->_apps = $apps;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->_language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->_language = $language;
    }

    /**
     * @return string
     */
    public function getContactPersonTitle()
    {
        return $this->_contactPersonTitle;
    }

    /**
     * @param string $contactPersonTitle
     */
    public function setContactPersonTitle($contactPersonTitle)
    {
        $this->_contactPersonTitle = $contactPersonTitle;
    }

    /**
     * @return string
     */
    public function getContactPersonFirstName()
    {
        return $this->_contactPersonFirstName;
    }

    /**
     * @param string $contactPersonFirstName
     */
    public function setContactPersonFirstName($contactPersonFirstName)
    {
        $this->_contactPersonFirstName = $contactPersonFirstName;
    }

    /**
     * @return string
     */
    public function getContactPersonLastName()
    {
        return $this->_contactPersonLastName;
    }

    /**
     * @param string $contactPersonLastName
     */
    public function setContactPersonLastName($contactPersonLastName)
    {
        $this->_contactPersonLastName = $contactPersonLastName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }
}
