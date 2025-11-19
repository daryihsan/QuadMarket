<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan route web untuk aplikasi Anda.
| Route ini dimuat oleh RouteServiceProvider dalam sebuah grup yang
| berisi middleware "web". Sekarang buat sesuatu yang hebat!
|
*/

Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'processStep1'])->name('register.step1.post');

Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'processStep2'])->name('register.step2.post');

Route::get('/register/step3', [RegisterController::class, 'showStep3'])->name('register.step3');
Route::post('/register/step3', [RegisterController::class, 'processStep3'])->name('register.step3.post');



// Tambahkan route login sebagai referensi
Route::get('/login', function () {
    return view('auth.login'); // Asumsi ada view login
})->name('login');

// Route Home setelah berhasil masuk
Route::get('/home', function () {
    return view('home'); // Asumsi ada view home
})->middleware('auth')->name('home');