<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherCityRequest;
use App\Http\Requests\WeatherGeoRequest;
use App\Http\Resources\WeatherResource;
use App\Models\Weather;
use App\Services\GetApiKeyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public string $apiKey;
    public string $url = "https://api.openweathermap.org/data/2.5/weather";
    public string $geocodingUrl = "http://api.openweathermap.org/geo/1.0/direct";

    public function __construct()
    {
        $this->apiKey = GetApiKeyService::getApiKey();
    }

    public function getWeatherByGeo(WeatherGeoRequest $request): JsonResponse
    {
        $data = $request->validated();

        $query = [
            'lat' => $data['lat'],
            'lon' => $data['lon'],
            'lang' => 'ru',
            'units' => 'metric',
            'appid' => $this->apiKey
        ];
        $response = Http::get($this->url, $query);

        if ($response->successful()) {
            $weatherData = $response->json();
            return response()->json($weatherData, 201);
        } else {
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
    }

    public function getWeatherByCity(WeatherCityRequest $request): JsonResponse
    {
        $data = $request->validated();

        $query = [
            'q' => $data['city'],
            'appid' => $this->apiKey
        ];
        $geoByCityNameResponse = Http::get($this->geocodingUrl, $query);

        if ($geoByCityNameResponse->successful()) {
            $responseData = $geoByCityNameResponse->json();

            $cityQuery = [
                'lon' => $responseData['lon'],
                'lat' => $responseData['lat'],
                'lang' => 'ru',
                'units' => 'metric',
                'appid' => $this->apiKey
            ];
            $weatherResponse = Http::get($this->url, $cityQuery);

            if ($weatherResponse->successful()) {
                $weatherData = $weatherResponse->json();
                return response()->json($weatherData, 201);

            } else {
                return response()->json(['error' => 'Unable to fetch data']);
            }

        } else {
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
    }
}
