<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

//Google
Route::get('login/google/redirect', [GoogleController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect-google');

Route::get('login/google/callback', [GoogleController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

Route::post('logout-google', [GoogleController::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout-google');

//Facebook
Route::get('login/facebook/redirect', [FacebookController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect-facebook');

Route::get('login/facebook/callback', [FacebookController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

Route::post('logout-facebook', [FacebookController::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout-facebook');

Route::get('/json', [HomeController::class, 'indexJson'])->name('json-data');

// Registrasi dan Login Manual
Route::get('register', [RegisterController::class, 'showRegistrationForm'])
    ->middleware(['guest'])
    ->name('show-registration-form');

Route::post('register', [RegisterController::class, 'register'])
    ->middleware(['guest'])
    ->name('register');

Route::get('login', [LoginController::class, 'showLoginForm'])
    ->middleware(['guest'])
    ->name('login');

Route::post('login', [LoginController::class, 'login'])
    ->middleware(['guest']);

Route::post('logout', [LoginController::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout');
