<?php

/**
 * 返回Config
 * @return \AliPay\Bean\Config
 */
function getAliPayConfig()
{
    $options = new \AliPay\Bean\Config();
    $options->protocol = 'https';
    $options->gatewayHost = 'openapi.alipay.com';



    return $options;
}