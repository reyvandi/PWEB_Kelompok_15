<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('WEATHERAPI_KEY');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $region = $request->input('region');

        // Get current weather
        $currentUrl = "https://api.weatherapi.com/v1/current.json?key={$this->apiKey}&q={$city},{$region}";
        $currentResponse = Http::withOptions(['verify' => false])->get($currentUrl);

        if (!$currentResponse->successful()) {
            return response()->json(['error' => 'Unable to fetch current weather data'], 500);
        }

        $currentData = $currentResponse->json();

        // Get historical data (last 7 days)
        $historyData = $this->getHistoricalWeather($city, $region);

        $weather = [
            'current' => [
                'temperature' => $currentData['current']['temp_c'],
                'humidity' => $currentData['current']['humidity'],
                'rain' => $currentData['current']['precip_mm'] ?? 0,
            ],
            'history' => $historyData
        ];

        return response()->json($weather);
    }

    private function getHistoricalWeather($city, $region)
    {
        $history = [];

        // Get data for each of the last 7 days
        for ($i = 1; $i <= 7; $i++) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $url = "https://api.weatherapi.com/v1/history.json?key={$this->apiKey}&q={$city},{$region}&dt={$date}";

            $response = Http::withOptions(['verify' => false])->get($url);

            if ($response->successful()) {
                $data = $response->json();

                // Get average conditions for the day
                $dayData = $data['forecast']['forecastday'][0]['day'];

                $history[] = [
                    'date' => $date,
                    'temperature' => $dayData['avgtemp_c'],
                    'humidity' => $dayData['avghumidity'],
                    'rain' => $dayData['totalprecip_mm']
                ];
            }
        }

        return $history;
    }
}
