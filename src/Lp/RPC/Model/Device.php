<?php

/**
 * Lp_RPC_Model_Device
 *
 * @author Tobias Fonfara
 */

require_once(realpath(dirname(__FILE__) . '/FieldSet.php'));

class Lp_RPC_Model_Device
{

    /**
     * @var string $_uid
     */
    protected $_uid;

    /**
     * @var string $_type
     */
    protected $_type;

    /**
     * @var string $_environment
     */
    protected $_environment;

    /**
     * @var Lp_RPC_Model_FieldSet $_fieldSet
     */
    protected $_fieldSet;

    /**
     * @var string $_infoHardware
     */
    protected $_infoHardware;

    /**
     * @var string $_infoSystem
     */
    protected $_infoSystem;

    /**
     * @var string $_infoSystemLanguage
     */
    protected $_infoSystemLanguage;

    /**
     * @var string $_infoTimezone
     */
    protected $_infoTimezone;

    /**
     * @param string                $uid
     * @param string                $type
     * @param string                $environment
     * @param Lp_RPC_Model_FieldSet $fieldSet
     * @param string                $infoHardware
     * @param string                $infoSystem
     * @param string                $infoSystemLanguage
     * @param string                $infoTimezone
     */
    public function __construct ($uid, $type, $environment, $fieldSet = null, $infoHardware = null, $infoSystem = null, $infoSystemLanguage = null, $infoTimezone = null)
    {
        $this->_uid                = $uid;
        $this->_type               = $type;
        $this->_environment        = $environment;
        $this->_fieldSet           = is_null($fieldSet) ? new Lp_RPC_Model_FieldSet() : $fieldSet;
        $this->_infoHardware       = $infoHardware;
        $this->_infoSystem         = $infoSystem;
        $this->_infoSystemLanguage = $infoSystemLanguage;
        $this->_infoTimezone       = $infoTimezone;
    }

    /**
     * @return string
     */
    public function getUid ()
    {
        return $this->_uid;
    }

    /**
     * @return string
     */
    public function getType ()
    {
        return $this->_type;
    }

    /**
     * @return string
     */
    public function getEnvironment ()
    {
        return $this->_environment;
    }

    /**
     * @return Lp_RPC_Model_FieldSet
     */
    public function getFieldSet ()
    {
        return $this->_fieldSet;
    }

    /**
     * @return string
     */
    public function getInfoHardware ()
    {
        return $this->_infoHardware;
    }

    /**
     * @return string
     */
    public function getInfoSystem ()
    {
        return $this->_infoSystem;
    }

    /**
     * @return string
     */
    public function getInfoSystemLanguage ()
    {
        return $this->_infoSystemLanguage;
    }

    /**
     * @return string
     */
    public function getInfoTimezone ()
    {
        return $this->_infoTimezone;
    }

}
