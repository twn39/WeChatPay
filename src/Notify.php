<?php

namespace Monster\WeChatPay;

class Notify
{

    /**
     * @param $xml
     * @return array
     */
    public static function parseXML($xml)
    {
        $dataObj = simplexml_load_string($xml);

        $data = [];

        $data['appid'] = (string) $dataObj->appid;
        $data['bank_type'] = (string) $dataObj->bank_type;
        $cashFee = (string) $dataObj->cash_fee;
        $data['cash_fee'] = $cashFee / 100;
        $data['fee_type'] = (string) $dataObj->fee_type;
        $data['is_subscribe'] = (string) $dataObj->is_subscribe;
        $data['mch_id'] = (string) $dataObj->mch_id;
        $data['nonce_str'] = (string) $dataObj->nonce_str;
        $data['openid'] = (string) $dataObj->openid;
        $data['out_trade_no'] = (string) $dataObj->out_trade_no;
        $data['result_code'] = (string) $dataObj->result_code;
        $data['return_code'] = (string) $dataObj->return_code;
        $data['sign'] = (string) $dataObj->sign;
        $data['time_end'] = (string) $dataObj->time_end;
        $totalFee = (string) $dataObj->total_fee;
        $data['total_fee'] = $totalFee / 100;
        $data['trade_type'] = (string) $dataObj->trade_type;
        $data['transaction_id'] = (string) $dataObj->transaction_id;

        return $data;
    }
}
