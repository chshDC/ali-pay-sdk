<?php

namespace AliPay\Bean;

class BaseContent
{
    public $app_id;
    public $method;
    public $format = "json";
    public $charset = "utf-8";
    public $sign_type = "RSA2";
    public $sign;
    public $timestamp;
    public $version = "1.0";
    public $biz_content;
    public $notify_url;
    public $return_url;

    /**
     * @param BizContent $biz_content
     */
    public function setBizContent($biz_content)
    {
        $data = json_decode(json_encode($biz_content), true);
        $this->biz_content = array_filter($data);
    }


    public function __construct($method)
    {
        $this->method = $method;
        $this->timestamp = date('Y-m-d H:i:s', time());
    }


    public function result()
    {
        $data = json_decode(json_encode($this), true);
        $data['biz_content'] = json_encode($data['biz_content']);
        ksort($data);
        $data = array_filter($data);
        return $data;
    }

}