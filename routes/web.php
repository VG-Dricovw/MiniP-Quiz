<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('account')->group(function () {
    Route::post('/login', [LoginController::class, 'appLogin'])->name('login');
    Route::post('/register', [LoginController::class, 'appRegister'])->name('register');
    Route::get('/logout', [LoginController::class, 'appLogout'])->name('logout');
});

Route::group([], function () {
    Route::get('/login', [LoginController::class,'app']);
    Route::get('/register', [LoginController::class,'app']);
    Route::get('/logout', [LoginController::class,'app']);
});

Route::resources([
    'quiz' => QuizController::class,
    'users' => UserController::class
]);

Route::get('/start', [QuizController::class, 'take']);