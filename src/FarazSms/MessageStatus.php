<?php
namespace Sunnyr\Sms\FarazSms;
use Closure;
use Sunnyr\Sms\Traits\Specifications;
use Sunnyr\Sms\Contracts\MessageStatusInterface;

class MessageStatus implements MessageStatusInterface {
	use Specifications;

    protected const FINISHED = 'Finish';
    protected const INTERACTING = 'Interacting';
    protected const NOTAUTHENTICATED = 'NoAuthentication';
    protected const ACTIVE = 'Active';
    protected const CANCEL = 'Cancel';
    protected const RECHARGE = 'No Sufficient Charge';
	protected const APPROVE = 'approve';
	protected const NOTCONFIRM = 'notconfirm:';

    public function __construct()
	{
		$this->setConfigDetails('farazsms');
	}

    public function check($code, ?Closure $callback=null) 
    {
        $url = "https://ippanel.com/services.jspd";
		$param = array
					(
						'uname'     =>  $this->username,
						'pass'      =>  $this->password,
						'op'        =>  'checkmessage',
						'messageid' =>  (int)$code
					);
					
		$handler = curl_init($url);             
		curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);                            
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		$response2 = curl_exec($handler);
		$response2 = json_decode($response2);
		
		if(isset($response2->statusMessage)){
			$response = [
				'status' => $this->translateStatus($response2->statusMessage),
			    'validation' => $this->translateValidation($response2->validMessage)
			];
		}

		return $response;
		// else {
		// 	$res_code = $response2[0];
		// 	$res_data = $response2[1];
		// 	dd($response2);

		// 	echo $res_data;
		// }

    }

    public function translateStatus($response): string
    {
        return match($response)
        {
            self::FINISHED   		 => 'FINISHED',
            self::INTERACTING      	 => 'INTERACTING',
            self::NOTAUTHENTICATED   => 'NOTAUTHENTICATED',
            self::ACTIVE    		 => 'ACTIVE',
            self::CANCEL 			 => 'CANCEL',
            self::RECHARGE 			 => 'RECHARGE'
        };
    }

	public function translateValidation($response)
	{
		return match($response)
        {
            self::APPROVE  		=> 'APPROVED',
            self::NOTCONFIRM 	=> 'NOTCONFIRMED',
        };
	}

}

