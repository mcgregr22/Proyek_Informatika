<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\ProfilUserController;

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

    // =========================
    // HOMEPAGE USER
    // =========================
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    // Detail buku
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // =========================
    // KERANJANG (Controller)
    // =========================
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');

    // =========================
    // ADMIN
    // =========================
    Route::get('/homepage_admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');
    Route::post('/homepage_admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');
    Route::delete('/homepage_admin/hapus/{id}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

    // PROFIL ADMIN
    Route::get('/profil_admin', [ProfilAdminController::class, 'index'])->name('profil_admin');

    // PROFIL USER
    Route::get('/profil_user', [ProfilUserController::class, 'index'])->name('profil_user');

    // =========================
    // HALAMAN TAMBAHAN
    // =========================
    Route::view('/mycollection', 'mycollection')->name('mycollection');
    Route::view('/forumdiscuss', 'forumdiscuss')->name('forumdiscuss');

    // =========================
    // PENGELOLAAN & SWAPBOOK
    // =========================
    // Layout utama pengelolaan (sidebar dan header)
  Route::get('/pengelolaan', fn() => view('pengelolaan'))->name('pengelolaan');
  
    // Halaman Book Swap di dalam pengelolaan
   Route::view('/pengelolaan', 'pengelolaan')->name('pengelolaan');
Route::view('/pengelolaan/swapbook', 'swapbook')->name('pengelolaan.swapbook');

    // =========================
    // LOGOUT
    // =========================
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
