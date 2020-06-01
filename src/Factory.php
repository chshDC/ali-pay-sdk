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

    /**
     * @param BaseContent $baseContent
     * @return mixed
     * @throws \Exception
     */
    static function exec(BaseContent $baseContent)
    {
        $baseContent->app_id = self::$config->appId;
        $data = $baseContent->result();
        $data['sign'] = Sign::exec($data, self::$config->privateKey);


        $result = HTTP::getInstance()->get(self::$config->getHost(), $data);
        $dataKey = $baseContent->method . '.response';
        $dataKey = str_replace('.', '_', $dataKey);
        $verifyData = $result[$dataKey];
        $verifyStr = json_encode($verifyData);
        $sign = $result['sign'];
        $verifyResult = Sign::verify($verifyStr, $sign, self::$config->aliPublicKey);
        if ($verifyResult) {
            return $verifyData;
        } else {
            throw new \Exception('验签失败，数据并非来自支付宝，请注意！');
        }
    }

    static function create(BaseContent $baseContent)
    {
        $baseContent->app_id = self::$config->appId;
        $data = $baseContent->result();
        $data['sign'] = Sign::exec($data, self::$config->privateKey);

        return self::$config->getHost() . '?' . http_build_query($data);
//        if (!empty($data)) {
//            if (is_array($data)) {
//                $url .= '?' . http_build_query($data);
//            } else if (is_string($data)) {
//                $url .= '?' . $data;
//            } else {
//                throw new \Exception('get 请求，参数应为数组或HTTP query字符串！');
//            }
//        }
    }
}