<?php
/**
 * LPStatistics
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_Statistics
{

    /**
     * @var string $_date
     */
    protected $_date;

    /**
     * @var string $_timestampRun
     */
    protected $_timestampRun;

    /**
     * @var string $_durationMinToday
     */
    protected $_durationMinToday;

    /**
     * @var string $_durationMinTotal
     */
    protected $_durationMinTotal;

    /**
     * @var string $_durationMaxToday
     */
    protected $_durationMaxToday;

    /**
     * @var string $_durationMaxTotal
     */
    protected $_durationMaxTotal;

    /**
     * @var string $_durationAvgToday
     */
    protected $_durationAvgToday;

    /**
     * @var string $_durationAvgTotal
     */
    protected $_durationAvgTotal;

    /**
     * @var int $_messageCountToday
     */
    protected $_messageCountToday;

    /**
     * @var int $_messageCountTotal
     */
    protected $_messageCountTotal;

    /**
     * @var int $_messagesSentToday
     */
    protected $_messagesSentToday;

    /**
     * @var int $_messagesSentTotal
     */
    protected $_messagesSentTotal;

    /**
     * @var int $_messagesOpenedToday
     */
    protected $_messagesOpenedToday;

    /**
     * @var int $_messagesOpenedTotal
     */
    protected $_messagesOpenedTotal;

    /**
     * @var int $_activeDevicesToday
     */
    protected $_activeDevicesToday;

    /**
     * @var int $_activeDevicesTotal
     */
    protected $_activeDevicesTotal;

    /**
     * @var int $_activeDevicesIosToday
     */
    protected $_activeDevicesIosToday;

    /**
     * @var int $_activeDevicesIosTotal
     */
    protected $_activeDevicesIosTotal;

    /**
     * @var int $_activeDevicesAndroidToday
     */
    protected $_activeDevicesAndroidToday;

    /**
     * @var int $_activeDevicesAndroidTotal
     */
    protected $_activeDevicesAndroidTotal;

    /**
     * @var int $_activeDevicesWpToday
     */
    protected $_activeDevicesWpToday;

    /**
     * @var int $_activeDevicesWpTotal
     */
    protected $_activeDevicesWpTotal;

    /**
     * @var int $_inactiveDevicesToday
     */
    protected $_inactiveDevicesToday;

    /**
     * @var int $_inactiveDevicesTotal
     */
    protected $_inactiveDevicesTotal;

    /**
     * @var int $_inactiveDevicesIosToday
     */
    protected $_inactiveDevicesIosToday;

    /**
     * @var int $_inactiveDevicesIosTotal
     */
    protected $_inactiveDevicesIosTotal;

    /**
     * @var int $_inactiveDevicesAndroidToday
     */
    protected $_inactiveDevicesAndroidToday;

    /**
     * @var int $_inactiveDevicesAndroidTotal
     */
    protected $_inactiveDevicesAndroidTotal;

    /**
     * @var int $_inactiveDevicesWpToday
     */
    protected $_inactiveDevicesWpToday;

    /**
     * @var int $_inactiveDevicesWpTotal
     */
    protected $_inactiveDevicesWpTotal;

    /**
     * @var int $_invalidDevicesToday
     */
    protected $_invalidDevicesToday;

    /**
     * @var int $_invalidDevicesTotal
     */
    protected $_invalidDevicesTotal;

    /**
     * @var int $_invalidDevicesIosToday
     */
    protected $_invalidDevicesIosToday;

    /**
     * @var int $_invalidDevicesIosTotal
     */
    protected $_invalidDevicesIosTotal;

    /**
     * @var int $_invalidDevicesAndroidToday
     */
    protected $_invalidDevicesAndroidToday;

    /**
     * @var int $_invalidDevicesAndroidTotal
     */
    protected $_invalidDevicesAndroidTotal;

    /**
     * @var int $_invalidDevicesWpToday
     */
    protected $_invalidDevicesWpToday;

    /**
     * @var int $_invalidDevicesWpTotal
     */
    protected $_invalidDevicesWpTotal;

    /**
     * @var int
     */
    protected $_optedOut;

    /**
     * Construct
     *
     * @param array $object
     */
    public function __construct($object)
    {
        $ref = new ReflectionObject($this);
        foreach($ref->getProperties() as $refObj) {
            $refObj->setAccessible(true);
            $name = str_replace('_', '', $refObj->getName());

            if (isset($object[$name])) {
                $refObj->setValue($this, $object[$name]);
            }
        }
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        $string = '';
        $ref = new ReflectionObject($this);
        foreach($ref->getMethods() as $refObj) {
            $needle = 'get';
            if (!strncmp($refObj->getName(), $needle, strlen($needle))) {
                $string .= $refObj->getName() . ': ' . $ref->getMethod($refObj->getName())->invoke($this) . PHP_EOL;
            }
        }
        return $string;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * Get timestamp run
     *
     * @return string
     */
    public function getTimestampRun()
    {
        return $this->_timestampRun;
    }

    /**
     * Get duration min today
     *
     * @return string
     */
    public function getDurationMinToday()
    {
        return $this->_durationMinToday;
    }

    /**
     * Get duration min total
     *
     * @return string
     */
    public function getDurationMinTotal()
    {
        return $this->_durationMinTotal;
    }

    /**
     * Get duration max today
     *
     * @return string
     */
    public function getDurationMaxToday()
    {
        return $this->_durationMaxToday;
    }

    /**
     * Get duration max total
     *
     * @return string
     */
    public function getDurationMaxTotal()
    {
        return $this->_durationMaxTotal;
    }

    /**
     * Get duration avg today
     *
     * @return string
     */
    public function getDurationAvgToday()
    {
        return $this->_durationAvgToday;
    }

    /**
     * Get duration avg total
     *
     * @return string
     */
    public function getDurationAvgTotal()
    {
        return $this->_durationAvgTotal;
    }

    /**
     * Get message count today
     *
     * @return int
     */
    public function getMessageCountToday()
    {
        return ((int) $this->_messageCountToday);
    }

    /**
     * Get message count total
     *
     * @return int
     */
    public function getMessageCountTotal()
    {
        return ((int) $this->_messageCountTotal);
    }

    /**
     * Get messages sent today
     *
     * @return int
     */
    public function getMessagesSentToday()
    {
        return ((int) $this->_messagesSentToday);
    }

    /**
     * Get messages sent total
     *
     * @return int
     */
    public function getMessagesSentTotal()
    {
        return ((int) $this->_messagesSentTotal);
    }

    /**
     * Get messages opened today
     *
     * @return int
     */
    public function getMessagesOpenedToday()
    {
        return ((int) $this->_messagesOpenedToday);
    }

    /**
     * Get messages opened total
     *
     * @return int
     */
    public function getMessagesOpenedTotal()
    {
        return ((int) $this->_messagesOpenedTotal);
    }

    /**
     * Get active devices today
     *
     * @return int
     */
    public function getActiveDevicesToday()
    {
        return ((int) $this->_activeDevicesToday);
    }

    /**
     * Get active devices total
     *
     * @return int
     */
    public function getActiveDevicesTotal()
    {
        return ((int) $this->_activeDevicesTotal);
    }

    /**
     * Get active iOS devices today
     *
     * @return int
     */
    public function getActiveDevicesIosToday()
    {
        return ((int) $this->_activeDevicesIosToday);
    }

    /**
     * Get active iOS devices total
     *
     * @return int
     */
    public function getActiveDevicesIosTotal()
    {
        return ((int) $this->_activeDevicesIosTotal);
    }

    /**
     * Get active Android devices today
     *
     * @return int
     */
    public function getActiveDevicesAndroidToday()
    {
        return ((int) $this->_activeDevicesAndroidToday);
    }

    /**
     * Get active Android devices total
     *
     * @return int
     */
    public function getActiveDevicesAndroidTotal()
    {
        return ((int) $this->_activeDevicesAndroidTotal);
    }

    /**
     * Get active WP devices today
     *
     * @return int
     */
    public function getActiveDevicesWpToday()
    {
        return ((int) $this->_activeDevicesWpToday);
    }

    /**
     * Get active WP devices total
     *
     * @return int
     */
    public function getActiveDevicesWpTotal()
    {
        return ((int) $this->_activeDevicesWpTotal);
    }

    /**
     * Get inactive devices today
     *
     * @return int
     */
    public function getInactiveDevicesToday()
    {
        return ((int) $this->_inactiveDevicesToday);
    }

    /**
     * Get inactive devices total
     *
     * @return int
     */
    public function getInactiveDevicesTotal()
    {
        return ((int) $this->_inactiveDevicesTotal);
    }

    /**
     * Get inactive iOS devices today
     *
     * @return int
     */
    public function getInactiveDevicesIosToday()
    {
        return ((int) $this->_inactiveDevicesIosToday);
    }

    /**
     * Get inactive iOS devices total
     *
     * @return int
     */
    public function getInactiveDevicesIosTotal()
    {
        return ((int) $this->_inactiveDevicesIosTotal);
    }

    /**
     * Get inactive Android devices today
     *
     * @return int
     */
    public function getInactiveDevicesAndroidToday()
    {
        return ((int) $this->_inactiveDevicesAndroidToday);
    }

    /**
     * Get inactive Android devices total
     *
     * @return int
     */
    public function getInactiveDevicesAndroidTotal()
    {
        return ((int) $this->_inactiveDevicesAndroidTotal);
    }

    /**
     * Get inactive WP devices today
     *
     * @return int
     */
    public function getInactiveDevicesWpToday()
    {
        return ((int) $this->_inactiveDevicesWpToday);
    }

    /**
     * Get inactive WP devices total
     *
     * @return int
     */
    public function getInactiveDevicesWpTotal()
    {
        return ((int) $this->_inactiveDevicesWpTotal);
    }

    /**
     * Get invalid devices today
     *
     * @return int
     */
    public function getInvalidDevicesToday()
    {
        return ((int) $this->_invalidDevicesToday);
    }

    /**
     * Get invalid devices total
     *
     * @return int
     */
    public function getInvalidDevicesTotal()
    {
        return ((int) $this->_invalidDevicesTotal);
    }

    /**
     * Get invalid iOS devices today
     *
     * @return int
     */
    public function getInvalidDevicesIosToday()
    {
        return ((int) $this->_invalidDevicesIosToday);
    }

    /**
     * Get invalid iOS devices total
     *
     * @return int
     */
    public function getInvalidDevicesIosTotal()
    {
        return ((int) $this->_invalidDevicesIosTotal);
    }

    /**
     * Get invalid Android devices today
     *
     * @return int
     */
    public function getInvalidDevicesAndroidToday()
    {
        return ((int) $this->_invalidDevicesAndroidToday);
    }

    /**
     * Get invalid Android devices total
     *
     * @return int
     */
    public function getInvalidDevicesAndroidTotal()
    {
        return ((int) $this->_invalidDevicesAndroidTotal);
    }

    /**
     * Get invalid WP devices today
     *
     * @return int
     */
    public function getInvalidDevicesWpToday()
    {
        return ((int) $this->_invalidDevicesWpToday);
    }

    /**
     * Get invalid WP devices total
     *
     * @return int
     */
    public function getInvalidDevicesWpTotal()
    {
        return ((int) $this->_invalidDevicesWpTotal);
    }

    /**
     * @return int
     */
    public function getOptedOut()
    {
        return $this->_optedOut;
    }
}
