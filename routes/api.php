<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizAPIController;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidateJWTToken;

Route::middleware([ValidateJWTToken::class])-> group(function () {
    Route::apiResources([
        'quiz' => QuizAPIController::class,
        'users' => UserAPIController::class
    ]);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});