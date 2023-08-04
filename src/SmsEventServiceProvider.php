<?php

namespace Sunnyr\Sms;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class SmsEventServiceProvider extends ServiceProvider
{
        /**
     * The event handler mappings for the application.
     *
     * @var array
     */

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            'Sunnyr\Sms\Events\TestEvent',                
            'Sunnyr\Sms\Listeners\TestListener',
        );

        // Event::listen(
        //     'Sunnyr\Sms\Events\OneTimeCodeGeneratedEvent',
        //     'Sunnyr\Sms\Listeners\OneTimeCodeGeneratedListener'
        // );
    }
}
