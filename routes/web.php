<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('seller')->name('seller.')->group(function() {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});

Route::get('/', function () {
    return redirect()->route('login');
});

// PLATFORM ADMIN
Route::prefix('platform')->name('platform.')->group(function () {

    // Dashboard platform
    Route::get('/dashboard', function () {
        return view('platform.dashboard');
    })->name('dashboard');

    // Laporan index
    Route::get('/laporan', function () {
        return view('platform.laporan');
    })->name('laporan');

    // Laporan provinsi
    Route::get('/laporan/provinsi', function () {
        return view('platform.provinsi');
    })->name('laporan.provinsi');

    // Laporan produk
    Route::get('/laporan/produk', function () {
        return view('platform.produk');
    })->name('laporan.produk');
});
