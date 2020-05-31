<?php


namespace AliPay;


class Sign
{
    static function exec($data, $privateKey)
    {
        $private_key = "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . wordwrap($privateKey, 64, "\n", true) . PHP_EOL . "-----END RSA PRIVATE KEY-----";

        $res = openssl_get_privatekey($private_key);
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        return base64_encode($sign);
    }
}