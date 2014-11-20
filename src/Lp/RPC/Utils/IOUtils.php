<?php
/**
 * IOUtils
 *
 * @author Tobias Fonfara
 */
class Lp_RPC_Utils_IOUtils
{

    /**
     * Post
     *
     * @param string $url
     * @param string $data
     * @param string $contentType
     *
     * @return string
     *
     * @throws Exception
     */
    public static function post ($url, $data, $contentType)
    {

        $curlResult = NULL;
        $curlInfo   = NULL;

        $headers = array();
        $headers[] = 'Content-Type: ' . $contentType;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        // To be used *only* while developing
        if (\Lp_RPC_LPClient::DEBUG_MODE) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_URL, $url);

        $curlResult = curl_exec($curl);
        //$curlInfo   = curl_getinfo($curl);

        curl_close($curl);

        return $curlResult;

    }

}
