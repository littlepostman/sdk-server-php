<?php

require_once(realpath(dirname(__FILE__) . '/DeviceEnvironment.php'));

/**
 * Lp_RPC_Model_MessageStatus
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_MessageStatus
{

    const MESSAGE_STATUS_DRAFT     = 'draft';
    const MESSAGE_STATUS_PREPARING = 'preparing';
    const MESSAGE_STATUS_SCHEDULED = 'scheduled';
    const MESSAGE_STATUS_SENDING   = 'sending';
    const MESSAGE_STATUS_SENT      = 'sent';
    const MESSAGE_STATUS_ERROR     = 'error';


    /**
     * @var int $_id
     */
    protected $_id;

    /**
     * @var string $_content
     */
    protected $_content;

    /**
     * @var array $_data
     */
    protected $_data;

    /**
     * @var string $_date
     */
    protected $_date;

    /**
     * @var int $_recipients
     */
    protected $_recipients;

    /**
     * @var string $_sendAt
     */
    protected $_sendAt;

    /**
     * @var string $_sendUntil
     */
    protected $_sendUntil;

    /**
     * @var array $_statistics
     */
    protected $_statistics;


    /**
     * @param array $object
     */
    public function __construct ($object)
    {
        $ref = new ReflectionObject($this);
        foreach ($ref->getProperties() as $refObj) {
            $refObj->setAccessible(true);
            $name = str_replace('_', '', $refObj->getName());

            if (isset($object[$name])) {
                if ($name == 'data') {
                    $refObj->setValue($this, json_decode($object[$name], true));
                } else {
                    $refObj->setValue($this, $object[$name]);
                }
            }
        }
    }

    /**
     * @param int $id
     */
    public function setId ($id)
    {
        $this->_id = $id;
    }

    /**
     * @return int
     */
    public function getId ()
    {
        return $this->_id;
    }

    /**
     * @param string $content
     */
    public function setContent ($content)
    {
        $this->_content = $content;
    }

    /**
     * @return string
     */
    public function getContent ()
    {
        return $this->_content;
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
     * @param string $date
     */
    public function setDate ($date)
    {
        $this->_date = $date;
    }

    /**
     * @return string
     */
    public function getDate ()
    {
        return $this->_date;
    }

    /**
     * @param int $recipients
     */
    public function setRecipients ($recipients)
    {
        $this->_recipients = $recipients;
    }

    /**
     * @return int
     */
    public function getRecipients ()
    {
        return $this->_recipients;
    }

    /**
     * @param string $sendAt
     */
    public function setSendAt ($sendAt)
    {
        $this->_sendAt = $sendAt;
    }

    /**
     * @return string
     */
    public function getSendAt ()
    {
        return $this->_sendAt;
    }

    /**
     * @param string $sendUntil
     */
    public function setSendUntil ($sendUntil)
    {
        $this->_sendUntil = $sendUntil;
    }

    /**
     * @return string
     */
    public function getSendUntil ()
    {
        return $this->_sendUntil;
    }

    /**
     * @return array
     */
    public function getStatistics ()
    {
        return $this->_statistics;
    }

    /**
     * @return bool
     */
    public function wasSentToProductionEnvironment ()
    {
        return array_key_exists(Lp_RPC_Model_DeviceEnvironment::DEVICE_ENV_PROD, $this->_statistics);
    }

    /**
     * @return int|null
     */
    public function getCreatedAt ()
    {
        $earliestCreated = PHP_INT_MAX;

        foreach ($this->_statistics as $key => $allDeviceTypesStatistics) {
            if ($this->isDeviceEnvironment($key)) {
                foreach ($allDeviceTypesStatistics as $deviceTypeStatistics) {
                    $createdString = $deviceTypeStatistics['created'];

                    if ($createdString != null) {
                        $created = strtotime($createdString);

                        if ($created < $earliestCreated) {
                            $earliestCreated = $created;
                        }
                    }
                }
            }
        }

        return ($earliestCreated == PHP_INT_MAX ? null : $earliestCreated);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    private function isDeviceEnvironment ($value)
    {
        return ($value == Lp_RPC_Model_DeviceEnvironment::DEVICE_ENV_PROD ||
            $value == Lp_RPC_Model_DeviceEnvironment::DEVICE_ENV_DEV);
    }

    /**
     * @return string
     */
    public function getCreatedAtString ()
    {
        $dateTime = $this->getCreatedAt();

        return $this->_formatDateString($dateTime);
    }

    /**
     * @return string
     */
    public function getSendAtString()
    {
        $dateTime = $this->getSendAt();

        return $this->_formatDateString($dateTime);
    }

    /**
     * @return string
     */
    public function getSendUntilString()
    {
        $dateTime = $this->getSendUntil();

        return $this->_formatDateString($dateTime);
    }

    /**
     * @param string $dateTime
     *
     * @return string
     */
    private function _formatDateString($dateTime)
    {
        if ($dateTime != null) {
            return date('d M Y H:i:s', $dateTime);
        } else {
            return '';
        }
    }

    /**
     * @return int|null
     */
    public function getDeliveredAt ()
    {
        $earliestDelivered = 0;

        foreach ($this->_statistics as $key => $allDeviceTypesStatistics) {
            if ($this->isDeviceEnvironment($key)) {
                foreach ($allDeviceTypesStatistics as $deviceTypeStatistics) {
                    $deliveredString = $deviceTypeStatistics['delivered'];

                    if ($deliveredString != null) {
                        $delivered = strtotime($deliveredString);

                        if ($delivered > $earliestDelivered) {
                            $earliestDelivered = $delivered;
                        }
                    }
                }
            }
        }

        return ($earliestDelivered == 0 ? null : $earliestDelivered);
    }

    /**
     * @return string
     */
    public function getDeliveredAtString ()
    {
        $deliveredAt = $this->getDeliveredAt();

        if ($deliveredAt != null) {
            return date('d M Y H:i:s', $deliveredAt);
        } else {
            return '';
        }
    }

    /**
     * @return int
     */
    public function getNumberOfRecipients ()
    {
        $deviceCount = 0;

        foreach ($this->_statistics as $key => $allDeviceTypesStatistics) {
            if ($this->isDeviceEnvironment($key)) {
                foreach ($allDeviceTypesStatistics as $deviceTypeStatistics) {
                    $deviceCount += $deviceTypeStatistics['deviceCount'];
                }
            }
        }

        return $deviceCount;
    }

    /**
     * as a percentage
     *
     * @return float
     */
    public function getResponseRate()
    {
        $deviceCount = 0;
        $responses = 0;

        foreach ($this->_statistics as $key => $allDeviceTypesStatistics) {
            if ($this->isDeviceEnvironment($key)) {
                foreach ($allDeviceTypesStatistics as $deviceTypeStatistics) {
                    $deviceCount += $deviceTypeStatistics['deviceCount'];
                    $responses += (isset($deviceTypeStatistics['responses']) ? $deviceTypeStatistics['responses'] : 0);
                }
            }
        }

        if ($deviceCount == 0) {
            return 0;
        }

        return round($responses * 100 / $deviceCount, 2);
    }

}
