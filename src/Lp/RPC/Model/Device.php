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
     * @var string $uid
     */
    protected $uid;

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $environment
     */
    protected $environment;

    /**
     * @var \Lp_RPC_Model_Fieldset $fieldSet
     */
    protected $fieldSet;

    /**
     * @var string $infoHardware
     */
    protected $infoHardware;

    /**
     * @var string $infoSystem
     */
    protected $infoSystem;

    /**
     * @var string $infoSystemLanguage
     */
    protected $infoSystemLanguage;

    /**
     * @var string $infoTimezone
     */
    protected $infoTimezone;

    /**
     * @var bool
     */
    private $optedOut;


    /**
     * @param string                 $uid
     * @param string                 $type
     * @param string                 $environment
     * @param \Lp_RPC_Model_Fieldset $fieldSet
     * @param string                 $infoHardware
     * @param string                 $infoSystem
     * @param string                 $infoSystemLanguage
     * @param string                 $infoTimezone
     * @param int                    $optedOut
     */
    public function __construct($uid,
        $type,
        $environment,
        $fieldSet = null,
        $infoHardware = null,
        $infoSystem = null,
        $infoSystemLanguage = null,
        $infoTimezone = null,
        $optedOut = 0
    ) {
        $this->uid                = $uid;
        $this->type               = $type;
        $this->environment        = $environment;
        $this->fieldSet           = is_null($fieldSet) ? new \Lp_RPC_Model_Fieldset() : $fieldSet;
        $this->infoHardware       = $infoHardware;
        $this->infoSystem         = $infoSystem;
        $this->infoSystemLanguage = $infoSystemLanguage;
        $this->infoTimezone       = $infoTimezone;
        $this->optedOut           = (int) $optedOut;
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return Lp_RPC_ModelfieldSet
     */
    public function getFieldSet()
    {
        return $this->fieldSet;
    }

    /**
     * @return string
     */
    public function getInfoHardware()
    {
        return $this->infoHardware;
    }

    /**
     * @return string
     */
    public function getInfoSystem()
    {
        return $this->infoSystem;
    }

    /**
     * @return string
     */
    public function getInfoSystemLanguage()
    {
        return $this->infoSystemLanguage;
    }

    /**
     * @return string
     */
    public function getInfoTimezone()
    {
        return $this->infoTimezone;
    }

    /**
     * @return boolean
     */
    public function getOptedOut()
    {
        return $this->optedOut;
    }
}
