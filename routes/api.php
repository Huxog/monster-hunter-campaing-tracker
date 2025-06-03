<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\MapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('maps', MapController::class);
Route::apiResource('campaings', CampaignController::class);
