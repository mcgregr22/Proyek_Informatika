<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\ProfilUserController;

// ----------------------
// HALAMAN AWAL
// ----------------------
Route::get('/', function () {
    return view('welcome');
});

// ----------------------
// ROUTE UNTUK TAMU (BELUM LOGIN)
// ----------------------
Route::middleware('guest')->group(function () {
    // Registrasi
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    // Login
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

// ----------------------
// ROUTE UNTUK USER LOGIN (AUTH)
// ----------------------
Route::middleware('auth')->group(function () {

    // ----------------------
    // HOMEPAGE USER
    // ----------------------
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    // ----------------------
    // HOMEPAGE ADMIN
    // ----------------------
    Route::get('/homepage_admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');
    Route::post('/homepage_admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');
    Route::delete('/homepage_admin/hapus/{id}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

    // ----------------------
    // PROFIL
    // ----------------------
    Route::get('/profil_admin', [ProfilAdminController::class, 'index'])->name('profil_admin');
    Route::get('/profil_user', [ProfilUserController::class, 'index'])->name('profil_user');

    // ----------------------
    // HALAMAN TAMBAHAN (USER)
    // ----------------------
    Route::get('/pengelolaan', fn() => view('pengelolaan'))->name('pengelolaan');
    Route::get('/swapbook', fn() => view('swapbook'))->name('swapbook');
    Route::get('/keranjang', fn() => view('keranjang'))->name('keranjang');
    Route::get('/mycollection', fn() => view('mycollection'))->name('mycollection');
    Route::get('/forumdiscuss', fn() => view('forumdiscuss'))->name('forumdiscuss');

    // ----------------------
    // DETAIL BUKU
    // ----------------------
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // ----------------------
    // LOGOUT
    // ----------------------
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
