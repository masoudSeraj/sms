<?php namespace Sunnyr\Sms\FarazSms;

use Sunnyr\Sms\Contracts\SmsResponseInterface;
use Sunnyr\Sms\Models\SmsResponse;

class ResponseParser implements SmsResponseInterface
{
    public function __construct(protected $response)
    {

    }
    public function parse($userId, $message)
    {
        try{
            SmsResponse::create([
                'driver' => 'farazsms',
                'user_id' => $userId,
                'bulk_code' => $this->response['1'],
                'message' => $message['body'],
                'response' => json_encode($this->response)
            ]);
        } catch (\Exception $e) {
            throw new \Exception('خطایی رخ داد!');
        }
    }
}
