<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MobilController as AdminMobilController;
use App\Http\Controllers\Admin\MobilTipeController as AdminMobilTipeController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\PromoController as PromoController;
use App\Http\Controllers\Admin\PromoController as AdminPromoController;

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
// Route::get('/mobil/{nama_mobil}', [MobilController::class, 'show'])->name('mobil.show');
Route::get('/mobil/{mobil:slug}', [MobilController::class, 'show'])->name('mobil.show');

//Promo section
Route::get('/promo', [PromoController::class, 'index'])->name('promo');


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

        // CRUD Tipe Mobil
        Route::get('tipeMobil', [AdminMobilTipeController::class, 'index'])->name('mobil_tipe.index_tipe'); // Daftar tipe mobil
        Route::get('tipeMobil/create', [AdminMobilTipeController::class, 'create'])->name('mobil_tipe.create'); // Form tambah tipe mobil
        Route::post('tipeMobil', [AdminMobilTipeController::class, 'store'])->name('mobil_tipe.store'); // Proses simpan tipe mobil
        Route::get('tipeMobil/{tipe}', [AdminMobilTipeController::class, 'show'])->name('mobil_tipe.show'); // Tampil detail tipe mobil

        Route::get('tipeMobil/{tipe}/edit', [AdminMobilTipeController::class, 'edit'])->name('mobil_tipe.edit');  // Form edit tipe mobil
        Route::put('tipeMobil/{tipe}', [AdminMobilTipeController::class, 'update'])->name('mobil_tipe.update'); // Proses update tipe mobil

        Route::delete('tipeMobil/{tipe}', [AdminMobilTipeController::class, 'destroy'])->name('mobil_tipe.destroy'); // Proses hapus tipe mobil

        // Nested CRUD for Mobil Tipe (shallow)
        Route::resource('mobil.tipe', AdminMobilTipeController::class)->shallow();

        // Settings (Homepage banner & Contact)
        Route::get('settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // Promo Admin
        Route::get('promo', [AdminPromoController::class, 'index'])->name('promo.index');
        Route::post('promo', [AdminPromoController::class, 'store'])->name('promo.store');
        Route::delete('promo/{filename}', [AdminPromoController::class, 'destroy'])->name('promo.destroy');
    });
});
