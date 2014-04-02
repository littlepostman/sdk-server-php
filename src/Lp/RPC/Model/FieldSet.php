<?php

/**
 * Lp_RPC_Model_FieldSet
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_FieldSet
{

    /**
     * @var array $_data
     */
    protected $_data = array();

    /**
     * @param string $name
     * @param string $value
     *
     * @throws Exception
     */
    public function addField ($name, $value)
    {
        if (empty($name) || !isset($value)) {
            throw new Exception ('Failed to add field: Missing name or value');
        }
        $this->_data[$name] = $value;
    }

    /**
     * @return array
     */
    public function getData ()
    {
        return $this->_data;
    }

}
