<?php

namespace podcasthosting\VboutApiClient\Providers;

use Illuminate\Support\ServiceProvider;
use podcasthosting\VboutApiClient\Vbout;

class VboutServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Config publishen
        $this->mergeConfigFrom(__DIR__.'/../config/vbout.php', 'vbout');

        // Haupt-Klasse als Singleton binden, damit wir sie überall injecten können
        $this->app->singleton(Vbout::class, function ($app) {
            return new Vbout(config('vbout.api_key'));
        });
    }

    public function boot()
    {
        // Erlauben, dass User die config publisht: php artisan vendor:publish --tag=vbout-config
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/vbout.php' => config_path('vbout.php'),
            ], 'vbout-config');
        }
    }
}
