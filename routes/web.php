<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MobilController as AdminMobilController;
use App\Http\Controllers\Admin\MobilTipeController as AdminMobilTipeController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mobil/filter', [HomeController::class, 'filterMobil'])->name('mobil.filter');
Route::get('/mobil/{id}', [MobilController::class, 'show'])->name('mobil.show');

// Admin Panel Routes
Route::prefix('admin')->name('admin.')->group(function() {
    // Login & Logout
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Protected Admin Routes (harus login admin untuk akses)
    Route::middleware('auth:admin')->group(function() {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Mobil
        Route::resource('mobil', AdminMobilController::class);

        // CRUD Tipe Mobil - Definisikan route untuk daftar tipe mobil admin
        Route::get('tipeMobil', [AdminMobilTipeController::class, 'index'])->name('mobil_tipe.index_tipe'); // <-- Pastikan ini benar

        // Nested CRUD for Mobil Tipe (shallow)
        Route::resource('mobil.tipe', AdminMobilTipeController::class)->shallow();

        // Settings (Homepage banner & Contact)
        Route::get('settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
