<?php

namespace AliPay;

use AliPay\Bean\BaseContent;
use AliPay\Bean\BizContent;
use AliPay\Bean\Config;

class Factory
{

    static public Config $config;

    static function exec(BaseContent $baseContent)
    {
        $baseContent->app_id = $config->appId;
        $data = $baseContent->result();
        $data['sign'] = Sign::exec($data, $config->privateKey);

        dump($data);
    }
}