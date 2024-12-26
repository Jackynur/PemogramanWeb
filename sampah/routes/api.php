<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SampahController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('sampahs', SampahController::class)->withoutMiddleware(['auth:sanctum']);
Route::apiResource('kategoris', KategoriController::class)->withoutMiddleware(['auth:sanctum']);


