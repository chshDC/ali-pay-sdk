<?php


namespace AliPay;


class Sign
{
    static function exec($data, $privateKey)
    {
        if (is_array($data)) {
            $data = http_build_query($data);
            $data = urldecode($data);
        }
        $private_key = "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . wordwrap($privateKey, 64, "\n", true) . PHP_EOL . "-----END RSA PRIVATE KEY-----";
        $res = openssl_get_privatekey($private_key);
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        return base64_encode($sign);
    }

    static function verify($data, $sign, $key)
    {
        $sign = base64_decode($sign);
        $data = preg_replace_callback("#\\\u([0-9a-f]{4})#i",
            function ($r) {
                return iconv('UCS-2BE', 'UTF-8', pack('H4', $r[1]));
            },
            $data);
        $public_key = "-----BEGIN PUBLIC KEY-----" . PHP_EOL . wordwrap($key, 64, "\n", true) . PHP_EOL . "-----END PUBLIC KEY-----";
        return (bool)openssl_verify($data, $sign, $public_key, OPENSSL_ALGO_SHA256);
    }
    
}