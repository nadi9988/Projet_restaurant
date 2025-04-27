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
Route::get('/test', function () {
    return view ('test');
});