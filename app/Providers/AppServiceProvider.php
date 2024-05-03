<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WeatherService;
use GuzzleHttp\Client; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(WeatherService::class, function ($app) {
            $apiKey = '6fb70c93789ecf9407193cbac2c63f0a';
            $httpClient = new Client();
            return new WeatherService($apiKey, $httpClient);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
