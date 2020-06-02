<?php


namespace AliPay\bean;

class WapPay
{
    public $body;
    public $subject;
    public $out_trade_no;
    public $timeout_express;

    public $time_expire;
    public $total_amount;
    public $auth_token;
    public $goods_type;
    public $quit_url;
    public $passback_params;
    public $product_code = 'QUICK_WAP_WAY';

    public $promo_params;
    public $extend_params;
    public $merchant_order_no;
    public $enable_pay_channels;
    public $disable_pay_channels;
    public $store_id;
    private $goods_detail = array();
    public $specified_channel;
    public $business_params;
    public $ext_user_info;

    /**
     * @param GoodsDetail $goods_detail
     */
    public function addGoodsDetail($goods_detail)
    {
        array_push($this->goods_detail, $goods_detail);
    }

    public function result()
    {
        $data = json_decode(json_encode($this), true);
        if (!empty($this->goods_detail)) {
            $goodsDetails = json_decode(json_encode($this->goods_detail), true);
            $data['goods_details'] = array_map(function ($item) {
                return array_filter($item);
            }, $goodsDetails);
        }
        return array_filter($data);
    }
}

class ExtendParams
{
    public $sys_service_provider_id;
    public $hb_fq_num;
    public $hb_fq_seller_percent;
    public $industry_reflux_info;
    public $card_type;
}

class GoodsDetail
{
    public $goods_id;
    public $alipay_goods_id;
    public $goods_name;
    public $quantity;
    public $price;
    public $goods_category;
    public $categories_tree;
    public $body;
    public $show_url;
}

class ExtUserInfo
{
    private $name;
    private $mobile;
    private $cert_type;
    private $cert_no;
    private $min_age;
    private $fix_buyer;
    private $need_check_info;
}

