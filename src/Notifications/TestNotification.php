<?php

namespace Sunnyr\Sms\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Sunnyr\Sms\Channels\SendSmsChannel;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public string $body, public ?array $receivers=null)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SendSmsChannel::class];
    }

    public function toSms($notifiable)
    {
        return [
            'receivers' => $notifiable->username,
            'body'      => $this->body,
        ];
    }
}
