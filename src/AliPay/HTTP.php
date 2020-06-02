<?php


namespace AliPay;


class HTTP
{
    static private $curl;
    static private $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            //如果没有,则创建当前类的实例
            self::$instance = new self();
            self::$curl = curl_init();
            curl_setopt(self::$curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt(self::$curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt(self::$curl, CURLOPT_RETURNTRANSFER, 1);
        }
        return self::$instance;
    }

    /**
     * CURL GET 请求
     * @param $url
     * @param null $data
     * @param array $header
     * @return mixed
     * @throws \Exception
     */
    public function get($url, $data = null, $header = array())
    {
        if (!empty($data)) {
            if (is_array($data)) {
                $url .= '?' . http_build_query($data);
            } else if (is_string($data)) {
                $url .= '?' . $data;
            } else {
                throw new \Exception('get 请求，参数应为数组或HTTP query字符串！');
            }
        }
//        dump($url);
        curl_setopt(self::$curl, CURLOPT_URL, $url);
        curl_setopt(self::$curl, CURLOPT_CUSTOMREQUEST, 'GET');
        if (!empty($header)) {
            curl_setopt(self::$curl, CURLOPT_HTTPHEADER, $header);
        }
        $output = curl_exec(self::$curl);
        curl_close(self::$curl);
        return json_decode($output, true);
    }


    /**
     * @param $url
     * @param null $data
     * @param array $header
     * @return mixed
     * @throws \Exception
     */
    public function post($url, $data = null, $header = array())
    {
        if (!empty($data)) {
            if (!is_array($data)) {
                throw new \Exception('post 请求，参数只能为数组！');
            }
            curl_setopt(self::$curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt(self::$curl, CURLOPT_URL, $url);
        curl_setopt(self::$curl, CURLOPT_POST, 1);
        if (!empty($header)) {
            curl_setopt(self::$curl, CURLOPT_HTTPHEADER, $header);
        }
        $output = curl_exec(self::$curl);
        curl_close(self::$curl);
        return json_decode($output, true);
    }
}