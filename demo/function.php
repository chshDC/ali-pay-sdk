<?php

/**
 * 返回Config
 * @return \AliPay\Bean\Config
 */
function getAliPayConfig()
{
    $options = new \AliPay\Bean\Config();
    $options->protocol = 'https';
    $options->gatewayHost = '---openapi.alipay.com---';
    $options->appId = '---您的APPID---';
    $options->aliPublicKey = '---您的支付宝公钥---';
    $options->privateKey = '---您的私钥---';
    return $options;
}