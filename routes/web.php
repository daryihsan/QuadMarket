<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth')->prefix('seller')->name('seller.')->group(function() {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});

// Route::get('/home', function () {
//     return view('home');
// });
