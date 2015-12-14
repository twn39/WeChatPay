<?php

namespace Monster\WeChatPay;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class UnifiedOrder
{
    private $order;
    private $requestXML;
    private $responseXML;
    private $timeout = 30;
    private $responseContent = [];
    public $status = 'FAIL';
    private $returnMessage;

    const REMOTE_URL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    const PACKAGE = 'Sign=WXPay';

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->requestXML = $this->order->toXML();
        $this->client = new Client();
    }

    /**
     * @param $seconds
     */
    public function setTimeOut($seconds)
    {
        $this->timeout = $seconds;
    }

    /**
     * @throws Exception
     *
     * @return array
     */
    public function send()
    {
        $request = new Request('POST', self::REMOTE_URL, $header = [], $this->requestXML);
        $response = $this->client->send($request, ['timeout' => $this->timeout]);

        $this->responseXML = $response->getBody()->getContents();

        $responseObj = simplexml_load_string($this->responseXML);

        $this->status = (string) $responseObj->return_code;
        $this->returnMessage = (string) $responseObj->return_msg;

        if ($this->status !== 'SUCCESS') {
            throw new Exception($this->returnMessage);
        }

        $this->responseContent['appid'] = (string) $responseObj->appid;
        $this->responseContent['partnerid'] = (string) $responseObj->mch_id;
        $this->responseContent['noncestr'] = (string) $responseObj->nonce_str;
        $this->responseContent['prepayid'] = (string) $responseObj->prepay_id;

        return $this->responseContent;
    }

    /**
     * get origin xml response string.
     *
     * @return string
     */
    public function rawResponse()
    {
        if ($this->status !== 'SUCCESS') {
            $this->send();
        }

        return $this->responseXML;
    }

    /**
     * @throws Exception
     *
     * @return string
     */
    public function reSign()
    {
        if ($this->status !== 'SUCCESS') {
            $this->send();
        }

        $this->responseContent['timestamp'] = (string) time();
        $this->responseContent['package'] = self::PACKAGE;
        $this->responseContent['noncestr'] = $this->order->getNonceStr();

        $sign = $this->order->getSign($this->responseContent);

        return $sign;
    }

    /**
     * @return array
     */
    public function getPrePayOrder()
    {
        $this->responseContent['sign'] = $this->reSign();

        return $this->responseContent;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
