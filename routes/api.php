<?php

use App\Http\Controllers\API\CarApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OwnerApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/owners', [OwnerApiController::class, 'index']);
Route::get('/owners/{id}', [OwnerApiController::class, 'show']);
Route::post('/owners', [OwnerApiController::class, 'store']);
Route::put('/owners/{id}', [OwnerApiController::class, 'update']);
Route::delete('/owners/{id}', [OwnerApiController::class, 'destroy']);

Route::apiResource('cars', CarApiController::class)->only('index', 'show', 'store', 'update', 'destroy');
