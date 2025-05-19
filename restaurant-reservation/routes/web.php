<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\MenuCategoriesController;
use App\Http\Controllers\Admin\PlatController;
use App\Http\Controllers\Admin\HoraireController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\LivraisonController;
use App\Http\Controllers\Admin\LivreurController;
use App\Http\Controllers\ReservationController;

Route::middleware(['web'])->group(function () {

    // Authentification
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout')->name('logout');
    });

    // Routes admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/Admin', function () {
            return view('admin.admin');
        })->name('dashboard');
        Route::resource('/restaurants', RestaurantController::class);
        Route::resource('/menu-categories', MenuCategoriesController::class);
        Route::resource('/plat', PlatController::class);
        Route::resource('/horaire', HoraireController::class);
        Route::resource('/table', TableController::class);
        Route::resource('/commande', CommandeController::class);
    });

    // Route Reservation
    Route::get('/reservations', [ReservationController::class, 'index'])->name('Reservation');

    Route::get('/Accueil', function () {
        return view ('Accueil');
    });

    Route::get('/Restaurant', function () {
        return view ('Restaurant');
    });

});
