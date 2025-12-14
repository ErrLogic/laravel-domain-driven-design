<?php

use App\Interfaces\Http\Controllers\AuthController;
use App\Interfaces\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
});
