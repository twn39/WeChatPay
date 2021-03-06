<?php

require '../vendor/autoload.php';

use Monster\WeChatPay;

$config = new WeChatPay\Config(
    'wx08fea2xxxxxxxx',
    '1284xxxxx',
    '4e3a3ee44006xxxxxxxxxxxx',
    '64dc8c89f7310xxxxxxxxxxxx',
    'http://example.com/wechatpay/notify'
);

$order = new WeChatPay\Order($config);

$order->setBody('buy some product');
$order->setTotalFee(0.01);
$order->setProductId('20151212120434234435');
$order->setOutTradeNo('2015121213232424323523');

$unifiedOrder = new WeChatPay\Order\UnifiedOrder($order);

$response = $unifiedOrder->send();
var_dump($response);
$prePayOrder = $unifiedOrder->getPrePayOrder();
var_dump($prePayOrder);
