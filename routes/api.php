<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Tasks\TaskController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;

Route::get('/status', function () {
    return response()->json(['message' => "Hello World !!!! Tasks API"], 200);
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [LoginController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'index']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LogoutController::class, 'index']);
    Route::apiResource('/tasks', TaskController::class)->only(['index', 'store']);
});
