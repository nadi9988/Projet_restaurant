<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 

use App\Http\Controllers\AuthController;

// Authentification
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});
