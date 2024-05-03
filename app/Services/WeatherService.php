<?php

namespace App\Services;
use Illuminate\Support\Facades\Log; 


class WeatherService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getWeather($latitude, $longitude)
    {
    $url = "{$this->baseUrl}/weather?lat={$latitude}&lon={$longitude}&appid={$this->apiKey}&units=metric";

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        throw new \Exception("cURL error: {$error}");
    }

    curl_close($ch);

    $weatherData = json_decode($response, true);

    $weatherInfo = [
        'name' => $weatherData['name'],
        'description' => $weatherData['weather'][0]['description'],
    ];

    if (isset($weatherData['main']['temp'])) {
        $celsius = $weatherData['main']['temp'];
        $weatherInfo['temp_celsius'] = round($celsius, 1);
    }

    if (isset($weatherData['weather'][0]['icon'])) {
        $weatherInfo['weather_icon'] = $weatherData['weather'][0]['icon'];
    }

    return $weatherInfo;
}

}
