<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(App\Http\Controllers\ShowController::class)->group(function () {
    Route::get('/all_stones', 'allStones');
    Route::get('/all_minerals', 'allMinerals');
    Route::get('/all_territories', 'allTerritories');
});

Route::controller(App\Http\Controllers\CreateController::class)->group(function () {
    Route::post('/create_stone', 'createStones');
    Route::post('/create_mineral', 'createMinerals');
    Route::post('/create_territory', 'createTerritories');
});


Route::controller(App\Http\Controllers\ChangeController::class)->group(function () {
    Route::post('/change_stone', 'changeStones');
    Route::post('/change_mineral', 'changeMinerals');
    Route::post('/change_territory', 'changeTerritories');
});