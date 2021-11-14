<?php

use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Studio\Providers\StudioServiceProvider;
use WhatsAppDriver;

use Illuminate\Support\ServiceProvider;

class WhatsAppDriverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadDrivers();

        $this->publishes([
            __DIR__.'/../../stubs/whatsapp.php' => config_path('botman/whatsapp.php')
        ]);

        $this->mergeConfigFrom( __DIR__.'/../../stubs/whatsapp.php', 'botman.whatsapp');
    }

    protected function loadDrivers()
    {
        DriverManager::loadDriver(WhatsAppDriver::class);
    }

    protected function isRunningInBotManStudio()
    {
        return class_exists(StudioServiceProvider::class);
    }
}