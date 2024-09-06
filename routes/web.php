<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuizController;
use App\Http\Middleware\CheckIfUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidateAuthorization;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('account')->group(function () {
    Route::post('/login', [LoginController::class, 'appLogin'])->name('login');
    Route::post('/register', [LoginController::class, 'appRegister'])->name('register');
    Route::get('/logout', [LoginController::class, 'appLogout'])->name('logout');
});;

Route::group([], function () {
    Route::get('/login', [LoginController::class,'app']);
    Route::get('/register', [LoginController::class,'app']);
    Route::get('/logout', [LoginController::class,'app']);
});

Route::group(["middleware" => ValidateAuthorization::class], function () {
    Route::get("/quiz/display/{where}", [QuizController::class, "display"])->name("display");
    Route::post("/quiz/grade", [QuizController::class, "grade"])->name("grade");
    Route::resource("user", UserController::class);
    Route::resource("quiz", QuizController::class);
});


Route::get('/start', [QuizController::class, 'take']);
