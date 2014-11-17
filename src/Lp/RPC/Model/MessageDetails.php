<?php

/**
 * Lp_RPC_Model_MessageDetails
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_MessageDetails
{

    /**
     * @var int $_messageId
     */
    protected $_id;

    /**
     * @var string $_message
     */
    protected $_message;

    /**
     * @var array $_data
     */
    protected $_data;

    /**
     * @var array $_extendedData
     */
    protected $_extendedData;

    /**
     * @var array
     */
    private $pushData;
    private $expiry;
    private $scheduleDate;
    private $inboxOnly;
    private $iosExpiry;
    private $iosAlert;
    private $iosBadge;
    private $iosSound;
    private $iosData;
    private $androidTimeToLive;
    private $androidDelayWhileIdle;
    private $androidCollapseKey;
    private $androidData;


    /**
     * @param int    $id
     * @param string $message
     * @param array  $data
     * @param array  $extendedData
     */
    public function __construct($id, $message, $data, $extendedData)
    {
        $this->_id           = $id;
        $this->_message      = $message;
        $this->_data         = $data;
        $this->_extendedData = $extendedData;
    }


    /**
     * @return array
     */
    public function getPushData()
    {
        return $this->pushData;
    }

    /**
     * @param array $pushData
     */
    public function setPushData($pushData)
    {
        $this->pushData = $pushData;
    }

    /**
     * @return mixed
     */
    public function getAndroidCollapseKey()
    {
        return $this->androidCollapseKey;
    }

    /**
     * @param mixed $androidCollapseKey
     */
    public function setAndroidCollapseKey($androidCollapseKey)
    {
        $this->androidCollapseKey = $androidCollapseKey;
    }

    /**
     * @return mixed
     */
    public function getAndroidData()
    {
        return $this->androidData;
    }

    /**
     * @param mixed $androidData
     */
    public function setAndroidData($androidData)
    {
        $this->androidData = $androidData;
    }

    /**
     * @return mixed
     */
    public function getAndroidDelayWhileIdle()
    {
        return $this->androidDelayWhileIdle;
    }

    /**
     * @param mixed $androidDelayWhileIdle
     */
    public function setAndroidDelayWhileIdle($androidDelayWhileIdle)
    {
        $this->androidDelayWhileIdle = $androidDelayWhileIdle;
    }

    /**
     * @return mixed
     */
    public function getAndroidTimeToLive()
    {
        return $this->androidTimeToLive;
    }

    /**
     * @param mixed $androidTimeToLive
     */
    public function setAndroidTimeToLive($androidTimeToLive)
    {
        $this->androidTimeToLive = $androidTimeToLive;
    }

    /**
     * @return mixed
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @param mixed $expiry
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;
    }

    /**
     * @return mixed
     */
    public function getInboxOnly()
    {
        return $this->inboxOnly;
    }

    /**
     * @param mixed $inboxOnly
     */
    public function setInboxOnly($inboxOnly)
    {
        $this->inboxOnly = $inboxOnly;
    }

    /**
     * @return mixed
     */
    public function getIosAlert()
    {
        return $this->iosAlert;
    }

    /**
     * @param mixed $iosAlert
     */
    public function setIosAlert($iosAlert)
    {
        $this->iosAlert = $iosAlert;
    }

    /**
     * @return mixed
     */
    public function getIosBadge()
    {
        return $this->iosBadge;
    }

    /**
     * @param mixed $iosBadge
     */
    public function setIosBadge($iosBadge)
    {
        $this->iosBadge = $iosBadge;
    }

    /**
     * @return mixed
     */
    public function getIosData()
    {
        return $this->iosData;
    }

    /**
     * @param mixed $iosData
     */
    public function setIosData($iosData)
    {
        $this->iosData = $iosData;
    }

    /**
     * @return mixed
     */
    public function getIosExpiry()
    {
        return $this->iosExpiry;
    }

    /**
     * @param mixed $iosExpiry
     */
    public function setIosExpiry($iosExpiry)
    {
        $this->iosExpiry = $iosExpiry;
    }

    /**
     * @return mixed
     */
    public function getIosSound()
    {
        return $this->iosSound;
    }

    /**
     * @param mixed $iosSound
     */
    public function setIosSound($iosSound)
    {
        $this->iosSound = $iosSound;
    }

    /**
     * @return mixed
     */
    public function getScheduleDate()
    {
        return $this->scheduleDate;
    }

    /**
     * @param mixed $scheduleDate
     */
    public function setScheduleDate($scheduleDate)
    {
        $this->scheduleDate = $scheduleDate;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Preserved for backward compatibility. getContent() should be used instead.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getMessage();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @return array
     */
    public function getExtendedData()
    {
        return $this->_extendedData;
    }
}
