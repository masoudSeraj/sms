<?php namespace Sunnyr\Sms;

use Sunnyr\Sms\Managers\FarazManager;
use Illuminate\Support\ServiceProvider;
use Sunnyr\Sms\Managers\OperationManager;

class SmsServiceProvider extends ServiceProvider
{

    protected $currentDriver = FarazManager::class;

    protected $drivers = [
        'farazsms'  => FarazManager::class
    ];

    public function register()
    {
        $this->app->bind(OperationManager::class, function() {
            return new $this->currentDriver();
        });
    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sms.php', 'sunnyrsms');

        $this->loadMigrationsFrom([__DIR__.'/../database/migrations']);
        $driver = config('sunnyrsms.default');
        $this->currentDriver = $this->drivers[$driver];
    }
}
?>

