<?php

namespace Monster\WeChatPay;

class Order extends OrderAbstract
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
        $this->loadConfig();
    }

    private function loadConfig()
    {
        $this->order['appid'] = $this->config->appId;
        $this->order['mch_id'] = $this->config->mchId;
        $this->order['nonce_str'] = $this->getNonceStr();
        $this->order['fee_type'] = 'CNY';
        $this->order['spbill_create_ip'] = $_SERVER['REMOTE_ADDR'];
        $this->order['time_start'] = date('YmdHis');
        $this->order['time_expire'] = date('YmdHis', time() + 600);
        $this->order['notify_url'] = $this->config->notifyUrl;
        // TODO: get value from config
        $this->order['trade_type'] = 'APP';
    }

    public function setBody($body)
    {
        $this->order['body'] = $body;
    }

    public function setDetail($detail)
    {
        $this->order['detail'] = $detail;
    }

    public function setDeviceInfo()
    {
        // TODO:
    }

    public function setAttach($attach)
    {
        $this->order['attach'] = $attach;
    }

    public function setOutTradeNo($outTradeNo)
    {
        $this->order['out_trade_no'] = $outTradeNo;
    }

    public function setTotalFee($totalFee)
    {
        $this->order['total_fee'] = (int) ($totalFee * 100);
    }

    public function setGoodsTag($goodsTag)
    {
        $this->order['goods_tag'] = $goodsTag;
    }

    public function setTradeType($tradeType)
    {
        $this->order['trade_type'] = $tradeType;
    }

    public function setProductId($productId)
    {
        $this->order['product_id'] = $productId;
    }

    public function setLimitPay($limitPay)
    {
        $this->order['limit_pay'] = $limitPay;
    }

    public function setOpenId($openId)
    {
        $this->order['openid'] = $openId;
    }
}
