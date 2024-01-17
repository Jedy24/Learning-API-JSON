<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\HomeController;
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
