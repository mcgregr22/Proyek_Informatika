<?php

use Illuminate\Support\Facades\Route;

// Controller yang digunakan
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomePageAdminController;

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK TAMU (BELUM LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Halaman awal
    Route::get('/', function () {
        return view('welcome'); // halaman awal sebelum login
    });

    // Register
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    // Login
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK USER YANG SUDAH LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Homepage (user)
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    // Detail buku
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // Menu user
    Route::get('/swapbook', fn() => view('swapbook'));
    Route::get('/keranjang', fn() => view('keranjang'));
    Route::get('/mycollection', fn() => view('mycollection'));
    Route::get('/forumdiscuss', fn() => view('forumdiscuss'));

    // Profil user
    Route::get('/profil_user', fn() => view('profil_user'));

    // Request swap
    Route::get('/request_swap', fn() => view('request_swap'));

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Homepage / Dashboard admin
    Route::get('/homepage_admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');

    // Tambah data (misalnya admin menambah buku atau user)
    Route::post('/homepage_admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');

    // Hapus data
    Route::delete('/homepage_admin/hapus/{id}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

    // Manajemen admin (view)
    Route::get('/manajemen_admin', fn() => view('manajemen_admin'))->name('manajemen_admin');

    // Profil admin
    Route::get('/profil_admin', fn() => view('profil_admin'))->name('profil_admin');
});
