<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VerificationController;

// ==========================================================
// HOME
// ==========================================================
Route::get('/', function () {
    return view('home');
});

// ==========================================================
// REGISTER (3 STEP)
// ==========================================================
Route::prefix('register')->name('register.')->group(function () {

    Route::get('/step1', [RegisterController::class, 'showStep1'])->name('step1');
    Route::post('/step1', [RegisterController::class, 'processStep1'])->name('step1.post');

    Route::get('/step2', [RegisterController::class, 'showStep2'])->name('step2');
    Route::post('/step2', [RegisterController::class, 'processStep2'])->name('step2.post');

    Route::get('/step3', [RegisterController::class, 'showStep3'])->name('step3');
    Route::post('/step3', [RegisterController::class, 'processStep3'])->name('step3.post');

    Route::get('/success', [RegisterController::class, 'showSuccess'])->name('success');
});

// ==========================================================
// VERIFIKASI EMAIL
// ==========================================================
Route::get('/email/verify/{token}/{email}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('guest');

// ==========================================================
// LOGIN
// ==========================================================
Route::prefix('login')->group(function () {

    Route::get('/pilih', [LoginController::class, 'showPilih'])->name('login.pilih');

    Route::get('/login', [LoginController::class, 'showLogin'])->name('login.login');
    Route::post('/login', [LoginController::class, 'processLogin'])->name('login.post.login');

    Route::get('/admin', [LoginController::class, 'showAdmin'])->name('login.admin');
    Route::post('/admin', [LoginController::class, 'processAdmin'])->name('login.post.admin');
});

// Home setelah login
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// OTP
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

// ==========================================================
// PRODUK (UMUM)
// ==========================================================
Route::get('/product/detail', function () {
    return view('products.detail');
});

Route::get('/product/detail/ulasan', function () {
    return view('ulasan');
});

// ==========================================================
// PLATFORM ADMIN
// ==========================================================
Route::prefix('platform')->name('platform.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('platform.dashboard');
    })->name('dashboard');

    // Laporan
    Route::get('/laporan', function () {
        return view('platform.laporan');
    })->name('laporan');

    Route::get('/laporan/provinsi', function () {
        return view('platform.provinsi');
    })->name('laporan.provinsi');

    Route::get('/laporan/produk', function () {
        return view('platform.produk');
    })->name('laporan.produk');

    // Verifikasi Penjual
    Route::get('/verifikasi', [PlatformController::class, 'verificationList'])->name('verifikasi.list');
    Route::get('/verifikasi/{id}', [PlatformController::class, 'verificationDetail'])->name('verifikasi.detail');
    Route::post('/verifikasi/{id}/process', [PlatformController::class, 'processVerification'])->name('verifikasi.process');
});

// ==========================================================
// SELLER
// ==========================================================
Route::prefix('seller')->name('seller.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');

    // Products CRUD
    Route::post('/products/store', [SellerController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{product}', [SellerController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [SellerController::class, 'deleteProduct'])->name('products.destroy');

    // Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/download', [ReportController::class, 'downloadPdf'])->name('reports.download');
});

// ==========================================================
// LOGOUT
// ==========================================================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
