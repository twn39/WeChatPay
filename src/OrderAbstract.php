<?php


namespace Monster\WeChatPay;

abstract class OrderAbstract
{
    protected $order = [];
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $queryStringArray
     *
     * @return string
     */
    public function getSign(array $queryStringArray)
    {
        $queryString = $this->getQueryString($queryStringArray);

        $sign = strtoupper(md5($queryString));

        return $sign;
    }

    /**
     * @return string
     */
    public function getNonceStr()
    {
        return md5(openssl_random_pseudo_bytes(60));
    }

    /**
     * @param array $queryStringArray
     *
     * @return string
     */
    public function getQueryString(array $queryStringArray)
    {
        ksort($queryStringArray);

        $queryString = [];

        foreach ($queryStringArray as $key => $value) {
            $queryString[] = "$key=$value";
        }
        $queryString = implode($queryString, '&');

        return $queryString . '&key=' . $this->config->key;
    }

    /**
     * @return string
     */
    public function toXML()
    {
        $sign = $this->getSign($this->order);

        $this->order['sign'] = $sign;

        $dom = new \DOMDocument('1.0', 'utf-8');

        $xml = $dom->appendChild(new \DOMElement('xml'));

        foreach ($this->order as $key => $value) {
            $element = $xml->appendChild(new \DOMElement($key));
            $element->appendChild(new \DOMCdataSection($value));
        }

        return $dom->saveXML();
    }
}
