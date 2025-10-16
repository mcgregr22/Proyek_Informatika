<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\Auth\LoginController;

// ----------------------
// HALAMAN AWAL & UMUM
// ----------------------
Route::get('/', function () {
    return view('welcome');
});

// ----------------------
// REGISTER
// ----------------------
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    // LOGIN
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

// ----------------------
// LOGIN WAJIB UNTUK HALAMAN DALAM
// ----------------------
Route::middleware('auth')->group(function () {

    Route::get('/homepage', function () {
        return view('homepage');
    })->name('homepage');

    Route::get('/swapbook', function () {
        return view('swapbook');
    });

    Route::get('/keranjang', function () {
        return view('keranjang');
    });

    Route::get('/mycollection', function () {
        return view('mycollection');
    });

    Route::get('/forumdiscuss', function () {
        return view('forumdiscuss');
    });

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
