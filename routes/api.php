<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request){
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware("auth:sanctum")->group(function () {
    Route::post('post-type', [ConversionController::class, 'store']);
    Route::get('get-conversion', [ConversionController::class, 'getConversion']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
//1|f0lfzJVow8OHVe1bhViLkY52B8tLpE3aVsO5D1wW07cbb245