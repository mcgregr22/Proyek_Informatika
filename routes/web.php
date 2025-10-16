<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;

// ----------------------
// HALAMAN AWAL (Guest/Public)
// ----------------------
Route::get('/', function () {
    return view('welcome'); // halaman awal sebelum login
});

// ----------------------
// ROUTE UNTUK TAMU (BELUM LOGIN)
// ----------------------
Route::middleware('guest')->group(function () {
    // REGISTER
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    // LOGIN
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

// ----------------------
// ROUTE UNTUK USER YANG SUDAH LOGIN (AUTH)
// ----------------------
Route::middleware('auth')->group(function () {

    // HOMEPAGE DINAMIS
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    // HALAMAN LAIN
    Route::get('/swapbook', fn() => view('swapbook'));
    Route::get('/keranjang', fn() => view('keranjang'));
    Route::get('/mycollection', fn() => view('mycollection'));
    Route::get('/forumdiscuss', fn() => view('forumdiscuss'));

    // DETAIL BUKU
   Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');


    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
