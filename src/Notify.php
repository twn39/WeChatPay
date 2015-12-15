<?php

namespace Monster\WeChatPay;

class Notify
{
    /**
     * @param $xml
     *
     * @return array
     */
    public static function parseXML($xml)
    {
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        if (!empty($data['cash_fee'])) {
            $data['cash_fee'] = $data['cash_fee'] / 100;
        }

        if (!empty($data['total_fee'])) {
            $data['total_fee'] = $data['total_fee'] / 100;
        }

        return $data;
    }
}
