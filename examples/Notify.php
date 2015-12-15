<?php

require '../vendor/autoload.php';

use Monster\WeChatPay;

$xml = file_get_contents('php://input');

$notify = WeChatPay\XML::parse($xml);

var_dump($notify);

//  your code
