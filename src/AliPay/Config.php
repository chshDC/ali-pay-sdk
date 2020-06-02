<?php


namespace AliPay;


class Config
{
    public $appId;
    public $publicKey;
    public $privateKey;
    public $aliPublicKey;
    public $protocol;
    public $gatewayHost;

    public function getHost()
    {
        return $this->protocol . "://" . $this->gatewayHost . '/gateway.do';
    }
}