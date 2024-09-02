<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizAPIController;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\LoginController;

Route::apiResources([
    'quiz' => QuizAPIController::class,
    'users' => UserAPIController::class
]);

Route::post('/login', [LoginController::class, 'api']);

Route::get('/protected-endpoint', [LoginController::class,'protectedEndpoint']);