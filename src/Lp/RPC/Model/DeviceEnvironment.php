<?php
/**
 * LPDeviceEnvironment
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_DeviceEnvironment
{

    /**
     * const DEVICE_ENV_DEV
     */
    const DEVICE_ENV_DEV = 'DEV';

    /**
     * @const DEVICE_ENV_PROD
     */
    const DEVICE_ENV_PROD = 'PROD';

    /**
     * Get device environment
     *
     * @param string $string
     *
     * @return string
     */
    public static function getDeviceEnvironment ($string)
    {
        if ($string == self::DEVICE_ENV_PROD) {
            return self::DEVICE_ENV_PROD;
        } else {
            return self::DEVICE_ENV_DEV;
        }
    }

}
