<?php
 
namespace Sunnyr\Sms\Channels;
 
use Illuminate\Notifications\Notification;
use Sunnyr\Sms\Managers\OperationManager;

class SendSmsChannel
{
    public function __construct(public OperationManager $operationManager)
    {
    }

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toSms($notifiable);

        $send = $this->operationManager->operationSend();

        $response = $send->send($notifiable->username, $message['body']);

        $parsedResponse = $this->operationManager->operationParse($response);  
        
        $parsedResponse->parse($notifiable->id, $message);
    }
}

