<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PlatformController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LoginController;

Route::get('/', action: function () {
    return view('home');
});

// regist
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/step1', [RegisterController::class, 'showStep1'])
        ->name('step1');
    Route::post('/step1', [RegisterController::class, 'processStep1'])
        ->name('step1.post');

    Route::get('/step2', [RegisterController::class, 'showStep2'])
        ->name('step2');
    Route::post('/step2', [RegisterController::class, 'processStep2'])
        ->name('step2.post');

    Route::get('/step3', [RegisterController::class, 'showStep3'])
        ->name('step3');
    Route::post('/step3', [RegisterController::class, 'processStep3'])
        ->name('step3.post');

    Route::get('/success', [RegisterController::class, 'showSuccess'])
        ->name('success');
});

// ==========================================================
// VERIFIKASI EMAIL
// ==========================================================
Route::get('/email/verify/{token}/{email}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('guest');

// ==========================================================
// AUTH & LOGIN
// ==========================================================
Route::prefix('login')->group(function () {
    Route::get('/pilih', [LoginController::class, 'showPilih'])->name('login.pilih');

    Route::get('/login', [LoginController::class, 'showLogin'])->name('login.login'); // Menampilkan form
    Route::post('/login', [LoginController::class, 'processLogin'])->name('login.post.login'); // Memproses form post

    Route::get('/admin', [LoginController::class, 'showAdmin'])->name('login.admin'); // Menampilkan form
    Route::post('/admin', [LoginController::class, 'processAdmin'])->name('login.post.admin'); // Memproses form post
});

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

// katalog produk
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
// ==========================================================
// PLATFORM ADMIN (PlatformController)
// ... (Rute platform admin tidak diubah) ...
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
// Route Penjual (Seller) - MIDDLEWARE 'auth' DIHAPUS SEMENTARA UNTUK DEBUGGING
Route::prefix('seller')->name('seller.')->group(function () { 
    // Tampilan utama dashboard penjual
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');

    // PRODUCTS CRUD 
    Route::post('/products/store', [SellerController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{product}', [SellerController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [SellerController::class, 'deleteProduct'])->name('products.destroy'); 
    
    // Route untuk Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index'); // <-- Kunci: Diubah menjadi 'index'
    Route::get('/reports/download', [ReportController::class, 'downloadPdf'])->name('reports.download'); // <-- Kunci: Route name disimplifikasi
});
// Route::get('/home', function () {
//     return view('home');
// });
// Rute Logout yang benar (menggunakan POST)
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
