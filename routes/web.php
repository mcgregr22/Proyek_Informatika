<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KeranjangController;

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

    // =========================
    // KERANJANG 
    // =========================
    Route::middleware('auth')->group(function () {

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');


});
    // DETAIL BUKU
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});