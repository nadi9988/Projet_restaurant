<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view ('Auth/register');
});
Route::get('/login', function () {
    return view ('Auth/login');
});
Route::get('/Accueil', function () {
    return view ('Accueil');
});
Route::get('/Restaurant', function () {
    return view ('Restaurant');
});
Route::get('/Compte', function () {
    return view ('Compte');
});
Route::get('/Reservation', function () {
    return view ('Reservation');
});
Route::get('/Admin', function () {
    return view ('Admin');
});

use App\Http\Controllers\AuthController;

// Authentification
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

