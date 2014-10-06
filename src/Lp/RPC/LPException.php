<?php

/**
 * Little Postman PHP SDK
 *
 * Authors: Benjamin Broll, Carsten D. Decker, Krasimir Krastev, Tobias Fonfara
 * Copyright: © Little Postman GmbH, 2012-2014
 */

class Lp_RPC_LPException extends \Exception
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @param string     $message  = ''
     * @param int        $code     = 0
     * @param \Exception $previous = null
     * @param array      $data     = array()
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null, $data = array())
    {
        parent::__construct($message, $code, $previous);
        $this->setData($data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}
