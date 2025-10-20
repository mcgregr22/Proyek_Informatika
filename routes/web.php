<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomePageAdminController;
// ----------------------
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

// ROUTE UNTUK ADMIN
Route::get('/homepage_admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');

Route::post('/homepage_admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');

Route::delete('/homepage_admin/hapus/{id}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

//ROUTE PROFIL
Route::get('/profil_user', function () {
    return view('profil_user'); // halaman awal sebelum login
});
//ROUTE SWAPBOOK
// use App\Http\Controllers\SwapbookController;

// Route::get('/swapbook', [SwapbookController::class, 'index']);

Route::get('/request_swap', function () {
    return view('request_swap'); // halaman awal sebelum login
});

Route::get('/manajemen_admin', function () {
    return view('manajemen_admin'); // halaman awal sebelum login
});