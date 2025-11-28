<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PlatformController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
// DITAMBAHKAN: Use statement untuk VerificationController
use App\Http\Controllers\VerificationController; 

// ==========================================================
// REGISTRASI MULTI-STEP (RegisterController)
// ==========================================================
Route::get('/', function () {
    return view('home');
});

// regist
Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'processStep1'])->name('register.step1.post');

Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'processStep2'])->name('register.step2.post');

Route::get('/register/step3', [RegisterController::class, 'showStep3'])->name('register.step3');
Route::post('/register/step3', [RegisterController::class, 'processStep3'])->name('register.step3.post');

Route::get('/register/success', [RegisterController::class, 'showSuccess'])->name('register.success');

// ==========================================================
// VERIFIKASI EMAIL (PENTING: DITAMBAHKAN)
// Route ini menangani klik link aktivasi dari email.
// ==========================================================
Route::get('/email/verify/{token}/{email}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('guest'); // Hanya untuk user yang belum login


// ==========================================================
// AUTH & LOGIN (Disarankan menggunakan satu set route)
// ==========================================================
// Route Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Route Registrasi Tumpang Tindih (DIBERSIHKAN/DIHAPUS)
// Hapus atau komen route di bawah ini karena Anda sudah menggunakan RegisterController:
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);


// Route Home setelah berhasil masuk
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/product/detail', function () {
    return view('products.detail');
});

// Route Dashboard Umum (Jika user sudah login dan terverifikasi)
Route::get('/dashboard', function () {
    return view('platform.dashboard');
})->name('dashboard');

// ==========================================================
// PLATFORM ADMIN (PlatformController)
// ==========================================================
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
    
    // Verifikasi Penjual (SRS-MartPlace-02)
    Route::get('/verifikasi', [PlatformController::class, 'verificationList'])->name('verifikasi.list');
    Route::get('/verifikasi/{id}', [PlatformController::class, 'verificationDetail'])->name('verifikasi.detail');
    
    // POST Request untuk Aksi Terima/Tolak
    Route::post('/verifikasi/{id}/process', [PlatformController::class, 'processVerification'])->name('verifikasi.process');
});