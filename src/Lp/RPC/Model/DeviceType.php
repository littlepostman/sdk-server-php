<?php
/**
 * LPDeviceType
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Model_DeviceType
{

    /**
     * @const DEVICE_TYPE_ANDROID
     */
    const DEVICE_TYPE_ANDROID = 'ANDROID';

    /**
     * @const DEVICE_TYPE_IOS
     */
    const DEVICE_TYPE_IOS = 'IOS';

    /**
     * @const DEVICE_TYPE_WINDOWS_PHONE
     */
    const DEVICE_TYPE_WINDOWS_PHONE = 'WP';

    /**
     * Get device type
     *
     * @param string $string
     *
     * @return string
     */
    public static function getDeviceType ($string) {
        if ($string == self::DEVICE_TYPE_ANDROID) {
            return self::DEVICE_TYPE_ANDROID;
        } else if ($string == self::DEVICE_TYPE_WINDOWS_PHONE) {
            return self::DEVICE_TYPE_WINDOWS_PHONE;
        } else {
            return self::DEVICE_TYPE_IOS;
        }
    }

}