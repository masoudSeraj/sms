<?php

namespace Sunnyr\Sms\FarazSms;

use Closure;
use Sunnyr\Sms\Traits\Specifications;
use Sunnyr\Sms\Contracts\CheckDeliveryInterface;

class CheckDelivery implements CheckDeliveryInterface
{
	use Specifications;

	public const NOTSYNC = 'notsync';
    public const SEND = 'send';
    public const PENDING = 'pending';
    public const FAILED = 'failed';
    public const DISCARDED = 'discarded';
    public const DELIVERED = 'delivered';

	public function __construct()
	{
		$this->setConfigDetails('farazsms');
	}
    
    /**
     * Method check
     *
     * @param $code $code [explicite description]
     * @param ?Closure $callback [explicite description]
     *
     * @return string
     */
    public function check($code, ?Closure $callback=null)
    {
		$url = "https://ippanel.com/services.jspd";
		$param = array
					(
						'uname'=> $this->username,
						'pass'=> $this->password,
						'op'=>'delivery',
						'uinqid'=> (int)$code
					);
		
		$handler = curl_init($url);             
		curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($handler, CURLOPT_POSTFIELDS, $param);       
		curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);                
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		$response2 = curl_exec($handler);
		$response2 = json_decode($response2);
		$res_code = $response2[0];
		$res_data = $response2[1];

		$res_data = $this->parseResponse($res_data);

		if(isset($callback)){
			call_user_func($callback, $res_data);
		}
		
		return $res_data;
    }

	public function translate($response): string
    {
        return match($response)
        {
            self::NOTSYNC   => 'SENDING',
            self::SEND      => 'SENT',
            self::PENDING   => 'PENDING',
            self::FAILED    => 'FAILED',
            self::DISCARDED => 'BLACKED',
            self::DELIVERED => 'DELIVERED'
        };
    }
	protected function parseResponse($response)
	{
		return substr($response, 16, -2);
	}
}
