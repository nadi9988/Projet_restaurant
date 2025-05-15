<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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


/* Admin routes */
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/restaurant', [App\Http\Controllers\AdminController::class, 'restaurant'])->name('restaurant.index');
Route::delete('/admin/restaurant/{id}', [App\Http\Controllers\AdminController::class, 'deleteLaureat'])->name('delete.restaurant');
