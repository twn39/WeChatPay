<?php 

namespace Monster\WeChatPay;

class Config 
{
	public $appId;
	public $mchId;
	public $key;
	public $appSecret;
	public $notifyUrl;
	public $SSLCertPath;
	public $SSLKeyPath;
	public $reportLevel;
	
	
	public function __construct($appId, $mchId, $key, $appSecret, $notifyUrl)
	{
		$this->appId = $appId;
		$this->mchId = $mchId;
		$this->key = $key;
		$this->appSecret = $appSecret;
		$this->notifyUrl = $notifyUrl;
	}
	
	// TODO: add set & get method
}
