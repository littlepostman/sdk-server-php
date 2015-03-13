<?php

use \Lp\RPC\Model\User;


/**
 * LPClient
 *
 * @author Tobias Fonfara
 */

require_once(realpath(dirname(__FILE__) . '/JSON/LPJSON.php'));
require_once(realpath(dirname(__FILE__) . '/Utils/IOUtils.php'));
require_once(realpath(dirname(__FILE__) . '/LPException.php'));

class Lp_RPC_LPClient
{
    /**
     * @const LP_API_VERSION
     */
    const LP_API_VERSION = '1.0.52';

    /**
     * @const bool DEBUG_MODE
     */
    const DEBUG_MODE = false;

    /**
     * @const LP_SERVER_PRODUCTION
     */
    const LP_SERVER_PRODUCTION = 'https://api.littlepostman.com/rpc-api/';

    /**
     * @const LP_SERVER_DEVELOPMENT
     */
    const LP_SERVER_DEVELOPMENT = 'https://develop.littlepostman.cloudcontrolled.com/rpc-api/';

    /** @const string EXCEPTION_TEXT */
    const EXCEPTION_TEXT = 'Unexpected exception occurred while creating JSON POST data / parsing the API response';

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

    /** @var Closure */
    private $prepareParamsAndInvokeCallback;


    /**
     * @param string $authKey
     * @param string $serverUrl
     */
    public function __construct($authKey, $serverUrl = self::LP_SERVER_PRODUCTION)
    {
        $this->_setJsonHandler(new Lp_RPC_JSON_LPJSON($authKey));
        $this->_setServerUrl($serverUrl);

        $this->prepareParamsAndInvokeCallback = function (
            $prepareParamsMethodName,
            $invokeObjectName,
            array $methodArgs
        ) {
            $result = call_user_func_array(
                [$this, '_prepareParamsAndInvoke'],
                array_merge(
                    [$prepareParamsMethodName, $invokeObjectName],
                    $methodArgs
                )
            );

            return $result;
        };
    }

    /**
     * @param Lp_RPC_Model_DeviceFilter $deviceFilter
     *
     * @return int
     *
     * @throws Exception
     */
    public function createDeviceFilter($deviceFilter)
    {
        $prepareParamsMethodName = 'prepareDeviceFilterCreateCall';
        $invokeObjectName        = 'deviceFilter';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $result['result']['create'][0];
    }

    /**
     * @param Lp_RPC_Model_Field $field
     *
     * @throws Exception
     */
    public function createField($field)
    {
        $prepareParamsMethodName = 'prepareFieldCreateCall';
        $invokeObjectName        = 'field';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param int $id
     *
     * @throws Exception
     */
    public function deleteDeviceFilterById($id)
    {
        $prepareParamsMethodName = 'prepareDeviceFilterDeleteCall';
        $invokeObjectName        = 'deviceFilter';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return \Lp_RPC_Model_Customer
     *
     * @throws Exception
     */
    public function getCustomer($email, $password)
    {
        $prepareParamsMethodName = 'prepareUserLoginCall';
        $invokeObjectName        = 'user';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        $customer = $this->_jsonHandler->parseUserLoginResult($result);

        if (empty($customer)) {
            throw new Exception('No customer given for email and password');
        }

        return $customer;
    }

    /**
     * @param string $email
     *
     * @return array
     *
     * @throws Exception
     */
    public function setHasAcceptedTC($email)
    {
        $prepareParamsMethodName = 'prepareSetHasAcceptedTC';
        $invokeObjectName        = 'user';

        return call_user_func_array(
            [$this, '_prepareParamsAndInvoke'],
            array_merge(
                [$prepareParamsMethodName, $invokeObjectName],
                func_get_args()
            )
        );
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
    public function getDevices($offset = 0, $limit = 1000, $fieldSet = null)
    {
        $prepareParamsMethodName = 'prepareDeviceListCall';
        $invokeObjectName        = 'device';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseDeviceListResult($result);
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array
     *
     * @throws Exception
     */
    public function getDeviceFilters($offset = 0, $limit = 100)
    {
        $prepareParamsMethodName = 'prepareDeviceFilterListCall';
        $invokeObjectName        = 'deviceFilter';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseDeviceFilterListResult($result);
    }

    /**
     * @param array|Lp_RPC_Model_DeviceFilter $deviceFilterOrArrayOfDeviceFilters
     *
     * @return array
     *
     * @throws Exception
     */
    public function getDeviceFilterCriteriaCalcByDeviceFilters($deviceFilterOrArrayOfDeviceFilters)
    {
        if (!is_array($deviceFilterOrArrayOfDeviceFilters)) {
            $deviceFilterOrArrayOfDeviceFilters = [$deviceFilterOrArrayOfDeviceFilters];
        }

        if (!empty($deviceFilterOrArrayOfDeviceFilters)) {
            try {

                $params =
                    $this->_jsonHandler->prepareDeviceFilterCalcCriteriaCall($deviceFilterOrArrayOfDeviceFilters
                    );
                $result = $this->_invoke('deviceFilter', [$params]);
                $this->_validate($result);

                return $this->_jsonHandler->parseDeviceFilterCalcCriteriaResult($deviceFilterOrArrayOfDeviceFilters,
                    $result
                );
            } catch (Exception $e) {
                throw new Exception(self::EXCEPTION_TEXT, 0, $e);
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
    public function getFields($offset = 0, $limit = 100)
    {
        $prepareParamsMethodName = 'prepareFieldListCall';
        $invokeObjectName        = 'field';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseFieldListResult($result);
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array
     *
     * @throws Exception
     */
    public function getMessages($offset = 0, $limit = 100)
    {
        $prepareParamsMethodName = 'prepareMessageListCall';
        $invokeObjectName        = 'message';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseMessageListResult($result);
    }

    /**
     * @param array $ids
     *
     * @return array
     *
     * @throws Exception
     */
    public function getMessagesByIds($ids)
    {
        $prepareParamsMethodName = 'prepareMessageDetailsCall';
        $invokeObjectName        = 'message';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseMessageDetailsResult($result);
    }

    /**
     * @param \Lp_RPC_Model_MessageDetails $messageDetails
     */
    public function updateMessage(\Lp_RPC_Model_MessageDetails $messageDetails)
    {
        $prepareParamsMethodName = 'prepareUpdateMessage';
        $invokeObjectName        = 'message';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param int $messageId
     */
    public function deleteMessage($messageId)
    {
        $prepareParamsMethodName = 'prepareDeleteMessage';
        $invokeObjectName        = 'message';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param DateTime $startDate
     * @param DateTime $endDate
     *
     * @return array
     *
     * @throws Exception
     */
    public function getStatistics($startDate, $endDate)
    {
        $prepareParamsMethodName = 'prepareStatisticsStatisticsCall';
        $invokeObjectName        = 'statistics';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseStatisticsStatisticsResult($result);
    }

    /**
     * @param Lp_RPC_Model_Message                                  $message
     * @param array|string                                          $type
     * @param string                                                $env
     * @param Lp_RPC_Model_FieldSet|Lp_RPC_Model_DeviceFilter|array $fieldSetOrDeviceFilters
     * @param bool                                                  $inboxOnly
     *
     * @throws Exception
     */
    public function pushMessage($message,
        $type = null,
        $env = null,
        $fieldSetOrDeviceFilters = null,
        $inboxOnly = false
    ) {
        $prepareParamsMethodName = 'preparePushSendCall';
        $invokeObjectName        = 'push';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param \Lp_RPC_Model_Device $device
     *
     * @throws Exception
     */
    public function registerDevice($device)
    {
        $prepareParamsMethodName = 'prepareDeviceRegisterCall';
        $invokeObjectName        = 'device';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param \Lp_RPC_Model_Device $device
     * @param string               $lpUid
     *
     * @throws Exception
     */
    public function convertOptedOutDevice($device, $lpUid)
    {
        $prepareParamsMethodName = 'prepareConvertOptedOutDeviceCall';
        $invokeObjectName        = 'device';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param \Lp_RPC_Model_Device $device
     * @param string               $oldDeviceUid
     *
     * @throws Exception
     */
    public function optOutRegisteredDevice($device, $oldDeviceUid)
    {
        $prepareParamsMethodName = 'prepareOptOutRegisteredDeviceCall';
        $invokeObjectName        = 'device';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param Lp_RPC_Model_Device $device
     * @param array               $data
     *
     * @throws Exception
     */
    public function setDeviceData($device, $data)
    {
        $prepareParamsMethodName = 'prepareDeviceSetDataCall';
        $invokeObjectName        = 'device';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param Lp_RPC_Model_Device $device
     * @param int                 $offset
     * @param int                 $limit
     *
     * @return array
     *
     * @throws Exception
     */
    public function getDeviceMessageInbox($device, $offset = 0, $limit = 100)
    {
        $prepareParamsMethodName = 'prepareDeviceMessageInboxCall';
        $invokeObjectName        = 'device';

        // prepare the params and invoke with the arguments passed to the current method
        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param Lp_RPC_Model_Device $device
     * @param string              $eventType
     *
     * @throws Exception
     */
    public function registerDeviceEvent($device, $eventType)
    {
        $prepareParamsMethodName = 'prepareDeviceRegisterEventCall';
        $invokeObjectName        = 'device';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param Lp_RPC_Model_Device         $device
     * @param Lp_RPC_Model_MessageDetails $message
     *
     * @throws Exception
     */
    public function setDeviceMessageResponse($device, $message)
    {
        $prepareParamsMethodName = 'prepareResponseUpdateCall';
        $invokeObjectName        = 'response';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param Lp_RPC_Model_Device $device
     *
     * @throws Exception
     */
    public function unregisterDevice($device)
    {
        $prepareParamsMethodName = 'prepareDeviceUnregisterCall';
        $invokeObjectName        = 'device';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param Lp_RPC_Model_DeviceFilter $deviceFilter
     *
     * @return int
     *
     * @throws Exception
     */
    public function updateDeviceFilter($deviceFilter)
    {
        $prepareParamsMethodName = 'prepareDeviceFilterUpdateCall';
        $invokeObjectName        = 'deviceFilter';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $result['result']['update'][0];
    }

    /**
     * @param \Lp_RPC_Model_Customer $customer
     *
     * @return int
     *
     * @throws Exception
     */
    public function registerCustomer(\Lp_RPC_Model_Customer $customer)
    {
        $prepareParamsMethodName = 'prepareRegisterCustomerCall';
        $invokeObjectName        = 'customer';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseRegisterCustomerResult($result);
    }

    /**
     * @param string           $userAuthKey
     * @param Lp_RPC_Model_App $app
     */
    public function createApp($userAuthKey, \Lp_RPC_Model_App $app)
    {
        $prepareParamsMethodName = 'prepareCreateApp';
        $invokeObjectName        = 'app';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $userAuthKey
     * @param User   $user
     */
    public function createUser($userAuthKey, User $user)
    {
        $prepareParamsMethodName = 'prepareCreateUser';
        $invokeObjectName        = 'userAdditional';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $userAuthKey
     * @param User   $user
     */
    public function updateUser($userAuthKey, User $user)
    {
        $prepareParamsMethodName = 'prepareUpdateUser';
        $invokeObjectName        = 'userAdditional';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $userAuthKey
     * @param string $password
     */
    public function updateOwnPassword($userAuthKey, $password)
    {
        $prepareParamsMethodName = 'prepareUpdateOwnPassword';
        $invokeObjectName        = 'userAdditional';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $userAuthKey
     * @param string $email
     * @param string $password
     */
    public function sendWelcomeEmail($userAuthKey, $email, $password)
    {
        $prepareParamsMethodName = 'prepareSendWelcomeEmail';
        $invokeObjectName        = 'userAdditional';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $userAuthKey
     * @param int    $userId
     */
    public function deleteUser($userAuthKey, $userId)
    {
        $prepareParamsMethodName = 'prepareDeleteUser';
        $invokeObjectName        = 'userAdditional';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $androidAuthKey
     *
     * @return array
     */
    public function updateAppAndroidAuthKey($androidAuthKey)
    {
        $prepareParamsMethodName = 'prepareUpdateAppAndroidAuthKey';
        $invokeObjectName        = 'appCredentials';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $iOSCertFileContentsBase64
     * @param string $deviceEnv
     * @param string $passphrase
     *
     * @return array
     */
    public function updateAppIOSCert($iOSCertFileContentsBase64, $deviceEnv, $passphrase = '')
    {
        $prepareParamsMethodName = 'prepareUpdateAppIOSCert';
        $invokeObjectName        = 'appCredentials';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param int $appId
     *
     * @return array
     */
    public function getAppIOSCertsDetails()
    {
        $prepareParamsMethodName = 'prepare' . ucfirst(__FUNCTION__);
        $invokeObjectName        = 'appCredentials';

        return $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );
    }

    /**
     * @param string $tokenType
     *
     * @throws Exception
     */
    public function generateToken($tokenType)
    {
        $prepareParamsMethodName = 'prepareGenerateTokenCall';
        $invokeObjectName        = 'token';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseGenerateTokenResult($result);
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
        $prepareParamsMethodName = 'prepareImportListCall';
        $invokeObjectName        = 'import';

        $result = $this->prepareParamsAndInvokeCallback->__invoke(
            $prepareParamsMethodName,
            $invokeObjectName,
            func_get_args()
        );

        return $this->_jsonHandler->parseImportListResult($result);
    }

    /**
     * @param \Lp_RPC_JSON_LPJSON $jsonHandler
     */
    public function _setJsonHandler(\Lp_RPC_JSON_LPJSON $jsonHandler)
    {
        $this->_jsonHandler = $jsonHandler;
    }

    /**
     * @param bool $logEnabled
     */
    public function _setLogEnabled($logEnabled)
    {
        $this->_logEnabled = (bool) $logEnabled;
    }

    /**
     * @param string $serverUrl
     */
    public function _setServerUrl($serverUrl)
    {
        $this->_serverUrl = (string) $serverUrl;
    }

    /**
     * @param string $method
     * @param array  $params
     *
     * @return string
     */
    protected function _invoke($method, $params)
    {
        $rpc            = [];
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
     * @param array $result
     *
     * @throws Exception
     */
    protected function _validate($result)
    {
        $errors = $this->_jsonHandler->parseError($result);
        if (!empty($errors)) {
            $error = '';
            if (is_array($errors[0])) {
                $error = $errors[0][0];
            } else {
                $error = $errors[0];
            }

            if (empty($error)) {
                $error = 'RPC API result contains errors';
            }

            throw new Lp_RPC_LPException($error, null, null, $errors);
        }
    }

    /**
     * @param string $json
     */
    protected function _didReceiveJSON($json)
    {
        $this->_log('< ' . $json);
    }

    /**
     * @param string $json
     */
    protected function _willSendJSON($json)
    {
        $this->_log('> ' . $json);
    }

    /**
     * @param string $log
     */
    protected function _log($log)
    {
        if (!$this->_logEnabled) {
            return;
        }
        print (date('[d.m.Y H:i:s] ') . $log . PHP_EOL);
        flush();
    }

    /**
     * 1) uses the first argument at the method name which would prepare the params for the API call
     * 2) uses the second argument as the RPC API object that we are going to invoke the method on
     * 3) passes the rest of the arguments to the prepare call described in 1)
     *
     * @return NULL | array
     *
     * @throws Exception
     */
    private function _prepareParamsAndInvoke()
    {
        $functionArgs = func_get_args();

        $prepareParamsMethodName = array_shift($functionArgs);
        $invokeObjectName        = array_shift($functionArgs);

        try {
            $params = call_user_func_array(
                [$this->_jsonHandler, $prepareParamsMethodName],
                $functionArgs
            );

            $result = $this->_invoke($invokeObjectName, [$params]);

            $this->_validate($result);
        } catch (Exception $e) {
            throw new Exception(self::EXCEPTION_TEXT . ': ' . $e->getMessage(), 0, $e);
        }

        return $result;
    }

    /**
     * Debug version of the method
     *
     * @return NULL | array
     *
     * @throws Exception
     */
    private function _prepareParamsAndInvokeDebug()
    {
        $functionArgs = func_get_args();

        $prepareParamsMethodName = array_shift($functionArgs);
        $invokeObjectName        = array_shift($functionArgs);

        try {
            $params = call_user_func_array(
                [$this->_jsonHandler, $prepareParamsMethodName],
                $functionArgs
            );

            $result = $this->_invoke($invokeObjectName, [$params]);

            // @NB: this debug is placed here intentionally
            // (this method should only be used for testing purposes)
            \dbg($result);

            $this->_validate($result);
        } catch (Exception $e) {
            throw new Exception(self::EXCEPTION_TEXT, 0, $e);
        }

        return $result;
    }
}
