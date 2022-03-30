<?php

use Illuminate\Support\Facades\Route;


Route::apiResource('/belajars', App\Http\Controllers\Api\BelajarController::class);
Route::apiResource('/pengajars', App\Http\Controllers\Api\PengajarController::class);
Route::apiResource('/belajars/join/{id}', App\Http\Controllers\Api\BelajarController::class);