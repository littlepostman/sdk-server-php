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
     * @param int    $id
     * @param string $message
     * @param array  $data
     * @param array  $extendedData
     */
    public function __construct ($id, $message, $data, $extendedData)
    {
        $this->_id           = $id;
        $this->_message      = $message;
        $this->_data         = $data;
        $this->_extendedData = $extendedData;
    }

    /**
     * @return int
     */
    public function getId ()
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getMessage ()
    {
        return $this->_message;
    }

    /**
     * @return array
     */
    public function getData ()
    {
        return $this->_data;
    }

    /**
     * @return array
     */
    public function getExtendedData ()
    {
        return $this->_extendedData;
    }

}
