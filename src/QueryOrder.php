<?php

namespace Monster\WeChatPay;

class QueryOrder extends OrderAbstract
{
    private $config;

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
    }

    public function setTransactionId($transactionId)
    {
        $this->order['transaction_id'] = $transactionId;
    }

    public function setOutTradeNo($outTradeNo)
    {
        $this->order['out_trade_no'] = $outTradeNo;
    }
}
