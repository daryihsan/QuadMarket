<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
Route::get('/', action: function () {
    return view('home');
});
// regist
Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'processStep1'])->name('register.step1.post');

Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'processStep2'])->name('register.step2.post');

Route::get('/register/step3', [RegisterController::class, 'showStep3'])->name('register.step3');
Route::post('/register/step3', [RegisterController::class, 'processStep3'])->name('register.step3.post');
// Rute baru untuk halaman sukses
Route::get('/register/success', [RegisterController::class, 'showSuccess'])->name('register.success');

// Tambahkan route login sebagai referensi
Route::get('/login', function () {
    return view('auth.login'); // Asumsi ada view login
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');


// Route Home setelah berhasil masuk
Route::get('/home', function () {
    return view('home'); // Asumsi ada view home
})->middleware('auth')->name('home');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

//Route::get('/login', action: [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/product/detail', function () {
    return view('products.detail');
});

Route::middleware('auth')->prefix('seller')->name('seller.')->group(function() {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/products/create', [SellerDashboardController::class, 'createProduct'])->name('products.create');
});
Route::get('/seller/dashboard', action: function () {
    return view('seller.dashboard');
});
Route::get('/seller/product/create', action: function () {
    return view('seller.product.create');
});
Route::get('/seller/product/add', action: function () {
    return view('seller.product.add');
});
// Route::get('/home', function () {
//     return view('home');
// });
