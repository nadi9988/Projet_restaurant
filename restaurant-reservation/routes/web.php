<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 

Route::get('/welcome', [PageController::class, 'welcome']);
Route::get('/register', [PageController::class, 'register']);
Route::get('/login', [PageController::class, 'login']);
Route::get('/Accueil', [PageController::class, 'accueil']);
Route::get('/Restaurant', [PageController::class, 'restaurant']);
Route::get('/Compte', [PageController::class, 'compte']);
Route::get('/Reservation', [PageController::class, 'reservation']);
Route::get('/Admin', [PageController::class, 'admin']);
