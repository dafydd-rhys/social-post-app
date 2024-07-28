<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WeatherService;
use GuzzleHttp\Client; 

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(WeatherService::class, function ($app) {
            $apiKey = ''//hidden;
            return new WeatherService($apiKey);
        });
    }

    public function boot(): void
    {
        //
    }
}
