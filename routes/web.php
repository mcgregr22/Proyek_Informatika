<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\ProfilAdminController;

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
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

// ----------------------
// ROUTE UNTUK USER LOGIN (AUTH)
// ----------------------
Route::middleware('auth')->group(function () {

    // HOMEPAGE USER
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    // HOMEPAGE ADMIN
    Route::get('/homepage_admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');
    Route::post('/homepage_admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');
    Route::delete('/homepage_admin/hapus/{id}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

    // PROFIL ADMIN
    Route::get('/profil_admin', [ProfilAdminController::class, 'index'])->name('profil_admin');

    // PROFIL USER
    // PROFIL USER
    Route::get('/profil_user', [App\Http\Controllers\ProfilUserController::class, 'index'])->name('profil_user');


    // HALAMAN LAIN
    Route::get('/swapbook', fn() => view('swapbook'));
    Route::get('/keranjang', fn() => view('keranjang'));
    Route::get('/mycollection', fn() => view('mycollection'));
    Route::get('/forumdiscuss', fn() => view('forumdiscuss'));
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
