<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/weather', function() {
    $lat = request('lat');
    $lon = request('lon');
    $apiKey = Config::get('services.openweathermap.key');

    $response = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&exclude=current&appid=$apiKey");

    return $response->json();
});
