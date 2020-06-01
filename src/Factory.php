<?php

namespace AliPay;

use AliPay\Bean\BaseContent;
use AliPay\Bean\BizContent;
use AliPay\Bean\Config;

class Factory
{

    /**
     * @var Config
     */
    static public $config;

    static function exec(BaseContent $baseContent)
    {
        $baseContent->app_id = self::$config->appId;
        $data = $baseContent->result();
        $data['sign'] = Sign::exec($data, self::$config->privateKey);

        dump($data);
    }
}