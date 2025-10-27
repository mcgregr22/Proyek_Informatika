<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\KeranjangController;

// ----------------------
// HALAMAN AWAL (PUBLIC)
// ----------------------
Route::get('/', function () {
    return view('welcome');
});

// ----------------------
// TAMU (BELUM LOGIN)
// ----------------------
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

// ----------------------
// SUDAH LOGIN (AUTH)
// ----------------------
Route::middleware('auth')->group(function () {

    // Homepage user
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    // Detail buku
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // =========================
    // Keranjang (Controller)
    // =========================
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');

    // =========================
    // Admin (contoh sederhana)
    // =========================
    Route::get('/homepage_admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');
    Route::post('/homepage_admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');
    Route::delete('/homepage_admin/hapus/{id}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

    // -------------------------
    // Halaman statis lainnya
    // -------------------------
    // (tetap) mycollection & forumdiscuss
    Route::view('/mycollection', 'mycollection');
    Route::view('/forumdiscuss', 'forumdiscuss');

    // -------------------------
    // PENGELOLAAN + SWAPBOOK
    // -------------------------
    // Halaman utama pengelolaan (sidebar + header)
    Route::view('/pengelolaan', 'pengelolaan')->name('pengelolaan');

    // Halaman swapbook DIMUAT di dalam pengelolaan (kanan sidebar)
    // NOTE: ini ganti /swapbook lama
    Route::view('/pengelolaan/swapbook', 'bookswap')->name('pengelolaan.swapbook');


    Route::get('/swapbook', function () {
    return view('swapbook');
});


    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/profil_user', [App\Http\Controllers\ProfilUserController::class, 'index'])->name('profil_user');
