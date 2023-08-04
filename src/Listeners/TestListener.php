<?php

namespace Sunnyr\Sms\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Sunnyr\Company\Models\Settings;
use Sunnyr\Sms\Notifications\TestNotification;

class TestListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // dd('event dispatched');
        // $user = User::create([]);
        // $user = Settings::all();
        $user = User::factory()->create();
        // dd(User::all());
        // dd($user);

        // Notification::send($user, new TestNotification("test"));
        $user->notify(new TestNotification("test"));
    }
}
