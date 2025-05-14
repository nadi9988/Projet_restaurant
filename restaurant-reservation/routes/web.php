<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\MenuCategorieController;
use App\Http\Controllers\Admin\PlatController;
use App\Http\Controllers\Admin\HoraireController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\LivraisonController;
use App\Http\Controllers\Admin\LivreurController;



// Authentification
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});


Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('menucategories', MenuCategorieController::class);
    Route::resource('plats', PlatController::class);
    Route::resource('horaires', HoraireController::class);
    Route::resource('tables', TableController::class);
    Route::resource('commandes', CommandeController::class);
    Route::resource('livraisons', LivraisonController::class);
    Route::resource('livreurs', LivreurController::class);

});


