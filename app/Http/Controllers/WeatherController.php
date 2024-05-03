<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Log; 

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function data(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $weatherData = $this->weatherService->getWeather($latitude, $longitude);

        return response()->json($weatherData);
    }

}
