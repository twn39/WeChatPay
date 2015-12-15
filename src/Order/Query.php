<?php

namespace Monster\WeChatPay\Order;

use GuzzleHttp\Client;
use Monster\WeChatPay\QueryOrder;

class Query
{
    const REMOTE_URL = 'https://api.mch.weixin.qq.com/pay/orderquery';

    private $queryOrder;
    private $requestXML;
    private $client;

    public function __construct(QueryOrder $queryOrder)
    {
        $this->queryOrder = $queryOrder;
        $this->requestXML = $this->queryOrder->toXML();

        $this->client = new Client();
    }
}
