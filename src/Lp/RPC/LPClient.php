<?php

/**
 * LPClient
 *
 * @author Tobias Fonfara
 */

require_once(realpath(dirname(__FILE__) . '/JSON/LPJSON.php'));
require_once(realpath(dirname(__FILE__) . '/Utils/IOUtils.php'));

class Lp_RPC_LPClient
{

    /**
     * @const LP_API_VERSION
     */
    const LP_API_VERSION = '1.0.23';

    /**
     * @const LP_SERVER_PRODUCTION
     */
    const LP_SERVER_PRODUCTION = 'https://api.littlepostman.com/rpc-api/';

    /**
     * @const LP_SERVER_DEVELOPMENT
     */
    const LP_SERVER_DEVELOPMENT = 'https://develop.littlepostman.cloudcontrolled.com/rpc-api/';

    /**
     * @var Lp_RPC_JSON_LPJSON
     */
    protected $_jsonHandler;

    /**
     * @var bool
     */
    protected $_logEnabled = false;

    /**
     * @var string
     */
    protected $_serverUrl;

    /**
     * @var int
     */
    protected $_sequenceNumber = 0;

    /**
     * @param string $authKey
     * @param string $serverUrl
     */
    public function __construct ($authKey, $serverUrl = self::LP_SERVER_PRODUCTION)
    {
        $this->_setJsonHandler(new Lp_RPC_JSON_LPJSON($authKey));
        $this->_setServerUrl($serverUrl);
    }

    /**
     * @param Lp_RPC_Model_DeviceFilter $deviceFilter
     *
     * @return int
     *
     * @throws Exception
     */
    public function createDeviceFilter ($deviceFilter)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceFilterCreateCall($deviceFilter);
            $result = $this->_invoke('deviceFilter', array($params));
            $this->_validate($result);
            return $result['result']['create'][0];

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_Field $field
     *
     * @throws Exception
     */
    public function createField ($field)
    {
        try {

            $params = $this->_jsonHandler->prepareFieldCreateCall($field);
            $result = $this->_invoke('field', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param int $id
     *
     * @throws Exception
     */
    public function deleteDeviceFilterById ($id)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceFilterDeleteCall($id);
            $result = $this->_invoke('deviceFilter', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param $email
     * @param $password
     *
     * @return \Lp_RPC_Model_Customer
     *
     * @throws Exception
     */
    public function getCustomer ($email, $password)
    {
        try {

            $params = $this->_jsonHandler->prepareUserLoginCall($email, $password);
            $result = $this->_invoke('user', array($params));
            $this->_validate($result);
            $customer = $this->_jsonHandler->parseUserLoginResult($result);
            if (empty($customer)) {
                throw new Exception('No customer given for email and password');
            }
            return $customer;

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param int                   $offset
     * @param int                   $limit
     * @param Lp_RPC_Model_FieldSet $fieldSet
     *
     * @return array
     *
     * @throws Exception
     */
    public function getDevices ($offset = 0, $limit = 1000, $fieldSet = null)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceListCall($offset, $limit, $fieldSet);
            $result = $this->_invoke('device', array($params));
            $this->_validate($result);
            return $this->_jsonHandler->parseDeviceListResult($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array
     *
     * @throws Exception
     */
    public function getDeviceFilters ($offset = 0, $limit = 100)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceFilterListCall($offset, $limit);
            $result = $this->_invoke('deviceFilter', array($params));
            $this->_validate($result);
            return $this->_jsonHandler->parseDeviceFilterListResult($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param array|Lp_RPC_Model_DeviceFilter $deviceFilterOrArrayOfDeviceFilters
     *
     * @return array
     *
     * @throws Exception
     */
    public function getDeviceFilterCriteriaCalcByDeviceFilters ($deviceFilterOrArrayOfDeviceFilters)
    {
        if (!is_array($deviceFilterOrArrayOfDeviceFilters)) {
            $deviceFilterOrArrayOfDeviceFilters = array($deviceFilterOrArrayOfDeviceFilters);
        }
        if (!empty($deviceFilterOrArrayOfDeviceFilters)) {
            try {

                $params = $this->_jsonHandler->prepareDeviceFilterCalcCriteriaCall($deviceFilterOrArrayOfDeviceFilters);
                $result = $this->_invoke('deviceFilter', array($params));
                $this->_validate($result);
                return $this->_jsonHandler->parseDeviceFilterCalcCriteriaResult($deviceFilterOrArrayOfDeviceFilters, $result);

            } catch (Exception $e) {
                throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
            }
        }
        return $deviceFilterOrArrayOfDeviceFilters;
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array
     *
     * @throws Exception
     */
    public function getFields ($offset = 0, $limit = 100)
    {
        try {

            $params = $this->_jsonHandler->prepareFieldListCall($offset, $limit);
            $result = $this->_invoke('field', array($params));
            $this->_validate($result);
            return $this->_jsonHandler->parseFieldListResult($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array
     *
     * @throws Exception
     */
    public function getMessages ($offset = 0, $limit = 100)
    {
        try {

            $params = $this->_jsonHandler->prepareMessageListCall($offset, $limit);
            $result = $this->_invoke('message', array($params));
            $this->_validate($result);
            return $this->_jsonHandler->parseMessageListResult($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param array $ids
     *
     * @return array
     *
     * @throws Exception
     */
    public function getMessagesByIds ($ids)
    {
        try {

            $params = $this->_jsonHandler->prepareMessageDetailsCall($ids);
            $result = $this->_invoke('message', array($params));
            $this->_validate($result);
            return $this->_jsonHandler->parseMessageDetailsResult($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param DateTime $startDate
     * @param DateTime $endDate
     *
     * @return array
     *
     * @throws Exception
     */
    public function getStatistics ($startDate, $endDate)
    {
        try {

            $params = $this->_jsonHandler->prepareStatisticsStatisticsCall($startDate, $endDate);
            $result = $this->_invoke('statistics', array($params));
            $this->_validate($result);
            return $this->_jsonHandler->parseStatisticsStatisticsResult($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_Message                            $message
     * @param array|string                                    $type
     * @param string                                          $env
     * @param Lp_RPC_Model_FieldSet|Lp_RPC_Model_DeviceFilter $fieldSetOrDeviceFilter
     *
     * @throws Exception
     */
    public function pushMessage ($message, $type = null, $env = null, $fieldSetOrDeviceFilter = null)
    {
        try {

            $params = $this->_jsonHandler->preparePushSendCall($message, $type, $env, $fieldSetOrDeviceFilter);
            $result = $this->_invoke('push', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_Device $device
     *
     * @throws Exception
     */
    public function registerDevice ($device)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceRegisterCall($device);
            $result = $this->_invoke('device', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_Device $device
     * @param array               $data
     *
     * @throws Exception
     */
    public function setDeviceData ($device, $data)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceSetDataCall($device, $data);
            $result = $this->_invoke('device', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_Device $device
     * @param string              $eventType
     *
     * @throws Exception
     */
    public function registerDeviceEvent ($device, $eventType)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceRegisterEventCall($device, $eventType);
            $result = $this->_invoke('device', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_Device         $device
     * @param Lp_RPC_Model_MessageDetails $message
     *
     * @throws Exception
     */
    public function setDeviceMessageResponse ($device, $message)
    {
        try {

            $params = $this->_jsonHandler->prepareResponseUpdateCall($device, $message);
            $result = $this->_invoke('response', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_Device $device
     *
     * @throws Exception
     */
    public function unregisterDevice ($device)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceUnregisterCall($device);
            $result = $this->_invoke('device', array($params));
            $this->_validate($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param Lp_RPC_Model_DeviceFilter $deviceFilter
     *
     * @return int
     *
     * @throws Exception
     */
    public function updateDeviceFilter ($deviceFilter)
    {
        try {

            $params = $this->_jsonHandler->prepareDeviceFilterUpdateCall($deviceFilter);
            $result = $this->_invoke('deviceFilter', array($params));
            $this->_validate($result);
            return $result['result']['update'][0];

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param string $tokenType
     *
     * @throws Exception
     */
    public function generateToken($tokenType)
    {
        try {

            $params = $this->_jsonHandler->prepareGenerateTokenCall($tokenType);
            $result = $this->_invoke('token', array($params));
            $this->_validate($result);

            return $this->_jsonHandler->parseGenerateTokenResult($result);
        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array
     *
     * @throws Exception
     */
    public function getImports($offset = 0, $limit = 100)
    {
        try {

            $params = $this->_jsonHandler->prepareImportListCall($offset, $limit);
            $result = $this->_invoke('import', array($params));
            $this->_validate($result);
            return $this->_jsonHandler->parseImportListResult($result);

        } catch (Exception $e) {
            throw new Exception('Unexpected exception occurred while creating JSON POST data', 0, $e);
        }
    }

    /**
     * @param string $method
     * @param array  $params
     *
     * @return string
     */
    protected function _invoke ($method, $params)
    {
        $rpc            = array();
        $rpc['jsonrpc'] = '2.0';
        $rpc['method']  = $method;
        $rpc['params']  = $params;
        $rpc['id']      = $this->_sequenceNumber++;

        $sendJson = json_encode($rpc);

        $this->_willSendJSON($sendJson);

        $receiveJson = Lp_RPC_Utils_IOUtils::post($this->_serverUrl, $sendJson, 'application/json');

        $this->_didReceiveJSON($receiveJson);

        return json_decode($receiveJson, true);
    }

    /**
     * @param $result
     *
     * @throws Exception
     */
    protected function _validate ($result)
    {
        $errors = $this->_jsonHandler->parseError($result);
        if (!empty($errors)) {
            throw new Exception ('Unexpected exception occurred while parsing API errors');
        }
    }

    /**
     * @param string $json
     */
    protected function _didReceiveJSON ($json)
    {
        $this->_log('< ' . $json);
    }

    /**
     * @param string $json
     */
    protected function _willSendJSON ($json)
    {
        $this->_log('> ' . $json);
    }

    /**
     * @param string $log
     */
    protected function _log ($log)
    {
        if (!$this->_logEnabled) {
            return;
        }
        print (date('[d.m.Y H:i:s] ') . $log . PHP_EOL);
        flush();
    }

    /**
     * @param \Lp_RPC_JSON_LPJSON $jsonHandler
     */
    public function _setJsonHandler (\Lp_RPC_JSON_LPJSON $jsonHandler)
    {
        $this->_jsonHandler = $jsonHandler;
    }

    /**
     * @param bool $logEnabled
     */
    public function _setLogEnabled ($logEnabled)
    {
        $this->_logEnabled = (bool) $logEnabled;
    }

    /**
     * @param string $serverUrl
     */
    public function _setServerUrl ($serverUrl)
    {
        $this->_serverUrl = (string) $serverUrl;
    }

}
