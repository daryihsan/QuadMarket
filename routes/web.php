<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
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

// Route yang membutuhkan otentikasi (Halaman Seller)
Route::prefix('seller')->name('seller.')->group(function () {
    // Tampilan utama dashboard penjual, juga menangani switch tab
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');

    // PRODUCTS CRUD (Untuk digunakan dalam satu file dashboard.blade.php)
    Route::post('/products/store', [SellerController::class, 'storeProduct'])->name('products.store');
    // Tambahkan ID ke route update/delete
    Route::put('/products/{id}/update', [SellerController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [SellerController::class, 'deleteProduct'])->name('products.delete');
    
    // Asumsi logout adalah rute umum
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
// Route::get('/home', function () {
//     return view('home');
// });
// Rute Logout yang benar (menggunakan POST)
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');