<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\RuleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Device API
Route::get('/device', [DeviceController::class, 'index']);
Route::post('/device', [DeviceController::class, 'store']);
Route::get('/device/{id}', [DeviceController::class, 'show']);
Route::put('/device/{id}', [DeviceController::class, 'update']);
Route::delete('/device/{id}', [DeviceController::class, 'destroy']);

// Data API
Route::get('/data', [DataController::class, 'index']);
Route::post('/data', [DataController::class, 'store']);
Route::get('/data/{id}', [DataController::class, 'show']);
Route::put('/data/{id}', [DataController::class, 'update']);
Route::delete('/data/{id}', [DataController::class, 'destroy']);

// Rule API
Route::get('/rule', [RuleController::class, 'index']);
Route::post('/rule', [RuleController::class, 'store']);
Route::get('/rule/{id}', [RuleController::class, 'show']);
Route::put('/rule/{id}', [RuleController::class, 'update']);
Route::delete('/rule/{id}', [RuleController::class, 'destroy']);
