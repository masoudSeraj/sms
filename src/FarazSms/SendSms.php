<?php

namespace Sunnyr\Sms\FarazSms;

use Closure;
use Sunnyr\Sms\Models\SmsResponse;
use Sunnyr\Sms\Traits\Specifications;
use Sunnyr\Sms\Contracts\SendSmsInterface;
use phpDocumentor\Reflection\Types\Callable_;

class SendSms implements SendSmsInterface
{
	use Specifications;
	
	protected $response;

	public function __construct()
	{
		$this->setConfigDetails(config('sunnyrsms.default') ?? 'farazsms');
	}
		
	/**
	 * Method send
	 *
	 * @param array|string $recievers [explicite description]
	 * @param string $message [explicite description]
	 * 
	 * @return array
	 */
	public function send(array|string $recievers, string $message, ?Closure $callback=null) :array
	{
		if(is_string($recievers))
		{
			$recievers = [$recievers];
		}

		$url = $this->url;

		$rcpt_nm = $recievers;
		$param = array(
			'uname' 	=> $this->username,
			'pass' 		=> $this->password,
			'from' 		=> $this->from,
			'message'	=> $message,
			'to'		=> json_encode($rcpt_nm),
			'op'		=> 'send'
		);

		$handler = curl_init($url);
		curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		$response2 = curl_exec($handler);

		$response2 = json_decode($response2);

		if(isset($callback)){
			call_user_func($callback, $response2);
		}

		return $response2;
	}
}
