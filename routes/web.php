<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// PENGUNJUNG--------------------------------------------------------------------------
// homepage
Route::get('/', action: function () {
    return view('home');
});

// katalog produk
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');

// detail produk
Route::get('/product/detail', function () {
    return view('products.detail');
});

// PENJUAL--------------------------------------------------------------------------
// regist
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/step1', [RegisterController::class, 'showStep1']) ->name('step1');
    Route::post('/step1', [RegisterController::class, 'processStep1']) ->name('step1.post');

    Route::get('/step2', [RegisterController::class, 'showStep2']) ->name('step2');
    Route::post('/step2', [RegisterController::class, 'processStep2']) ->name('step2.post');

    Route::get('/step3', [RegisterController::class, 'showStep3']) ->name('step3');
    Route::post('/step3', [RegisterController::class, 'processStep3']) ->name('step3.post');

    // pendaftaran berhasil
    Route::get('/success', [RegisterController::class, 'showSuccess']) ->name('success');
});

// verif email
Route::get('/email/verify/{token}/{email}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('guest');

// login
Route::prefix('login')->group(function () {
    Route::get('/pilih', [LoginController::class, 'showPilih'])->name('login.pilih');

    Route::get('/login', [LoginController::class, 'showLogin'])->name('login.login');
    Route::post('/login', [LoginController::class, 'processLogin'])->name('login.post.login');

    Route::get('/admin', [LoginController::class, 'showAdmin'])->name('login.admin');
    Route::post('/admin', [LoginController::class, 'processAdmin'])->name('login.post.admin');
});

// ini ga pake middleware biar bisa logout
Route::prefix('seller')->name('seller.')->group(function () {
    // dashboard
    Route::get('/dashboard', [SellerController::class, 'dashboard']) ->name('dashboard');

    // CRUD produk
    Route::get('/products', [SellerController::class, 'listProducts'])->name('products.index');
    Route::get('/products/create', [SellerController::class, 'showCreateForm'])->name('products.create');
    Route::post('/products/store', [SellerController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{product}', [SellerController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [SellerController::class, 'deleteProduct'])->name('products.destroy');

    // laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/download', [ReportController::class, 'downloadPdf'])->name('reports.download');
});

// middleware auth login penjual (harus login baru bisa akses dashboard)
Route::middleware('auth')->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [SellerController::class, 'dashboard']) ->name('dashboard');
});

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN--------------------------------------------------------------------------
// platform
Route::prefix('platform')->name('platform.')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('platform.dashboard');
    })->name('dashboard');

    // laporan
    Route::get('/laporan', function () {
        return view('platform.laporan');
    })->name('laporan');

    // laporan provinsi
    Route::get('/laporan/provinsi', function () {
        return view('platform.provinsi');
    })->name('laporan.provinsi');

    // laporan produk
    Route::get('/laporan/produk', function () {
        return view('platform.produk');
    })->name('laporan.produk');
    
    // verifikasi penjual (SRS-MartPlace-02)
    Route::get('/verifikasi', [PlatformController::class, 'verificationList'])->name('verifikasi.list');
    Route::get('/verifikasi/{id}', [PlatformController::class, 'verificationDetail'])->name('verifikasi.detail');
    
    Route::post('/verifikasi/{id}/process', [PlatformController::class, 'processVerification'])->name('verifikasi.process');
});

// DRAFT!!!!!
// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth')->name('home');

// Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp');
// Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
