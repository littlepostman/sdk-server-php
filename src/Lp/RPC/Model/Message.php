<?php

/**
 * Lp_RPC_Model_Message
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_Message
{

    const MESSAGE_MAX_LENGTH = 512;

    /**
     * @var string $_content
     */
    protected $_content;

    /**
     * @var string $_expiryDate
     */
    protected $_expiryDate;

    /**
     * @var string $_scheduleDate
     */
    protected $_scheduleDate;

    /**
     * @var array $_data
     */
    protected $_data;

    /**
     * @var string $_iosExpiryDate
     */
    protected $_iosExpiryDate;

    /**
     * @var string $_iosAlert
     */
    protected $_iosAlert;

    /**
     * @var int $_iosBadge
     */
    protected $_iosBadge;

    /*
     * @var int $iosContentAvailable
     */
    protected $iosContentAvailable;

    /**
     * @var string $_iosSound
     */
    protected $_iosSound;

    /**
     * @var array $_iosData
     */
    protected $_iosData;

    /**
     * @var int $_androidTimeToLive
     */
    protected $_androidTimeToLive;

    /**
     * @var bool $_androidDelayWhileIdle
     */
    protected $_androidDelayWhileIdle;

    /**
     * @var string $_androidCollapseKey
     */
    protected $_androidCollapseKey;

    /**
     * @var array $_androidData
     */
    protected $_androidData;

    /**
     * @var string $_wpToastTitle
     */
    protected $_wpToastTitle;

    /**
     * @var string $_wpToastSubtitle
     */
    protected $_wpToastSubtitle;

    /**
     * @var string $_wpToastPath
     */
    protected $_wpToastPath;

    /**
     * @var array $_wpToastData
     */
    protected $_wpToastData;

    /**
     * @var string $_wpTileTitle
     */
    protected $_wpTileTitle;

    /**
     * @var int $_wpTileCount
     */
    protected $_wpTileCount;

    /**
     * @var string $_wpTileBackgroundImage
     */
    protected $_wpTileBackgroundImage;

    /**
     * @var string $_wpTileBackTitle
     */
    protected $_wpTileBackTitle;

    /**
     * @var string $_wpTileBackContent
     */
    protected $_wpTileBackContent;

    /**
     * @var string $_wpTileBackBackgroundImage
     */
    protected $_wpTileBackBackgroundImage;

    public function __construct ()
    {
    }

    /**
     * @return string
     */
    public function getContent ()
    {
        return $this->_content;
    }

    /**
     * @param string $content
     */
    public function setContent ($content)
    {
        $this->_content = $content;
    }

    /**
     * @param string $expiryDate
     */
    public function setExpiryDate ($expiryDate)
    {
        $this->_expiryDate = $expiryDate;
    }

    /**
     * @return string
     */
    public function getExpiryDate ()
    {
        return $this->_expiryDate;
    }

    /**
     * @param string $scheduleDate
     */
    public function setScheduleDate ($scheduleDate)
    {
        $this->_scheduleDate = $scheduleDate;
    }

    /**
     * @return string
     */
    public function getScheduleDate ()
    {
        return $this->_scheduleDate;
    }

    /**
     * @param array $data
     */
    public function setData ($data)
    {
        $this->_data = $data;
    }

    /**
     * @return array
     */
    public function getData ()
    {
        return $this->_data;
    }

    /**
     * @param string $iosExpiryDate
     */
    public function setIosExpiryDate ($iosExpiryDate)
    {
        $this->_iosExpiryDate = $iosExpiryDate;
    }

    /**
     * @return string
     */
    public function getIosExpiryDate ()
    {
        return $this->_iosExpiryDate;
    }

    /**
     * @param string $iosAlert
     */
    public function setIosAlert ($iosAlert)
    {
        $this->_iosAlert = $iosAlert;
    }

    /**
     * @return string
     */
    public function getIosAlert ()
    {
        return $this->_iosAlert;
    }

    /**
     * @param int $iosBadge
     */
    public function setIosBadge ($iosBadge)
    {
        $this->_iosBadge = $iosBadge;
    }

    /**
     * @return int
     */
    public function getIosBadge ()
    {
        return $this->_iosBadge;
    }

    /**
     * @return mixed
     */
    public function getIosContentAvailable()
    {
        return $this->iosContentAvailable;
    }

    /**
     * @param mixed $iosContentAvailable
     */
    public function setIosContentAvailable($iosContentAvailable)
    {
        $this->iosContentAvailable = $iosContentAvailable;
    }

    /**
     * @param string $iosSound
     */
    public function setIosSound ($iosSound)
    {
        $this->_iosSound = $iosSound;
    }

    /**
     * @return string
     */
    public function getIosSound ()
    {
        return $this->_iosSound;
    }

    /**
     * @param array $iosData
     */
    public function setIosData ($iosData)
    {
        $this->_iosData = $iosData;
    }

    /**
     * @return array
     */
    public function getIosData ()
    {
        return $this->_iosData;
    }

    /**
     * @param int $androidTimeToLive
     */
    public function setAndroidTimeToLive ($androidTimeToLive)
    {
        $this->_androidTimeToLive = $androidTimeToLive;
    }

    /**
     * @return int
     */
    public function getAndroidTimeToLive ()
    {
        return $this->_androidTimeToLive;
    }

    /**
     * @param boolean $androidDelayWhileIdle
     */
    public function setAndroidDelayWhileIdle ($androidDelayWhileIdle)
    {
        $this->_androidDelayWhileIdle = $androidDelayWhileIdle;
    }

    /**
     * @return boolean
     */
    public function getAndroidDelayWhileIdle ()
    {
        return $this->_androidDelayWhileIdle;
    }

    /**
     * @param string $androidCollapseKey
     */
    public function setAndroidCollapseKey ($androidCollapseKey)
    {
        $this->_androidCollapseKey = $androidCollapseKey;
    }

    /**
     * @return string
     */
    public function getAndroidCollapseKey ()
    {
        return $this->_androidCollapseKey;
    }

    /**
     * @param array $androidData
     */
    public function setAndroidData ($androidData)
    {
        $this->_androidData = $androidData;
    }

    /**
     * @return array
     */
    public function getAndroidData ()
    {
        return $this->_androidData;
    }

    /**
     * @param string $wpToastTitle
     */
    public function setWpToastTitle ($wpToastTitle)
    {
        $this->_wpToastTitle = $wpToastTitle;
    }

    /**
     * @return string
     */
    public function getWpToastTitle ()
    {
        return $this->_wpToastTitle;
    }

    /**
     * @param string $wpToastSubtitle
     */
    public function setWpToastSubtitle ($wpToastSubtitle)
    {
        $this->_wpToastSubtitle = $wpToastSubtitle;
    }

    /**
     * @return string
     */
    public function getWpToastSubtitle ()
    {
        return $this->_wpToastSubtitle;
    }

    /**
     * @param string $wpToastPath
     */
    public function setWpToastPath ($wpToastPath)
    {
        $this->_wpToastPath = $wpToastPath;
    }

    /**
     * @return string
     */
    public function getWpToastPath ()
    {
        return $this->_wpToastPath;
    }

    /**
     * @param array $wpToastData
     */
    public function setWpToastData ($wpToastData)
    {
        $this->_wpToastData = $wpToastData;
    }

    /**
     * @return array
     */
    public function getWpToastData ()
    {
        return $this->_wpToastData;
    }

    /**
     * @param string $wpTileTitle
     */
    public function setWpTileTitle ($wpTileTitle)
    {
        $this->_wpTileTitle = $wpTileTitle;
    }

    /**
     * @return string
     */
    public function getWpTileTitle ()
    {
        return $this->_wpTileTitle;
    }

    /**
     * @param int $wpTileCount
     */
    public function setWpTileCount ($wpTileCount)
    {
        $this->_wpTileCount = $wpTileCount;
    }

    /**
     * @return int
     */
    public function getWpTileCount ()
    {
        return $this->_wpTileCount;
    }

    /**
     * @param string $wpTileBackgroundImage
     */
    public function setWpTileBackgroundImage ($wpTileBackgroundImage)
    {
        $this->_wpTileBackgroundImage = $wpTileBackgroundImage;
    }

    /**
     * @return string
     */
    public function getWpTileBackgroundImage ()
    {
        return $this->_wpTileBackgroundImage;
    }

    /**
     * @param string $wpTileBackTitle
     */
    public function setWpTileBackTitle ($wpTileBackTitle)
    {
        $this->_wpTileBackTitle = $wpTileBackTitle;
    }

    /**
     * @return string
     */
    public function getWpTileBackTitle ()
    {
        return $this->_wpTileBackTitle;
    }

    /**
     * @param string $wpTileBackContent
     */
    public function setWpTileBackContent ($wpTileBackContent)
    {
        $this->_wpTileBackContent = $wpTileBackContent;
    }

    /**
     * @return string
     */
    public function getWpTileBackContent ()
    {
        return $this->_wpTileBackContent;
    }

    /**
     * @param string $wpTileBackBackgroundImage
     */
    public function setWpTileBackBackgroundImage ($wpTileBackBackgroundImage)
    {
        $this->_wpTileBackBackgroundImage = $wpTileBackBackgroundImage;
    }

    /**
     * @return string
     */
    public function getWpTileBackBackgroundImage ()
    {
        return $this->_wpTileBackBackgroundImage;
    }

    /**
     * @return bool
     */
    public function hasValidLength ()
    {
        return $this->validateLengthWithParams($this->_content, json_encode($this->_data), $this->_iosBadge);
    }

    /**
     * @param string $content
     * @param string $data
     * @param string $iosBadge
     *
     * @return bool
     */
    public static function validateLengthWithParams ($content, $data, $iosBadge)
    {
        return (mb_strlen((string) $content . (string) $data . (string) $iosBadge, 'utf8') <= self::MESSAGE_MAX_LENGTH);
    }

}
