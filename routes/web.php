<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('account/login');
});
Route::get('/register', function () {
    return view('account/register');
});


Route::resources([
    'quiz' => QuizController::class,
    'users' => UserController::class
]);

Route::get('/start', [QuizController::class, 'take']);