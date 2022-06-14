<?php

namespace LaravelEpayco;

use Epayco\Epayco;
use Illuminate\Support\ServiceProvider;

class EpaycoServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register a class in the service container
        $this->registerConfig();
    }

    public function boot()
    {
        // Register a macro, extending the Illuminate\Collection class

        $this->bindEpayco();
        $this->publishConfig();
    }

    private function bindEpayco()
    {
        $this->app->bind(Epayco::class, function ($app) {
            return new Epayco([
                "apiKey" => config('laravel-epayco.apiKey'),
                "privateKey" => config('laravel-epayco.privateKey'),
                "lenguage" => config('laravel-epayco.lenguage'),
                "test" => config('laravel-epayco.test')
            ]);
        });
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-epayco.php', 'laravel-epayco');
    }

    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-epayco.php' => config_path('laravel-epayco.php'),
        ], 'laravel-epayco');
    }
}
