<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\SwapbookController;
use App\Http\Controllers\MyCollectionController;
 

/* ----------------------
|  PUBLIC
|-----------------------*/
Route::get('/', fn () => view('welcome'));
Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

/* ----------------------
|  GUEST (belum login)
|-----------------------*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');
});

/* ----------------------
|  AUTH (sudah login)
|-----------------------*/
Route::middleware('auth')->group(function () {
    // Detail buku
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // Layout Pengelolaan
    Route::view('/pengelolaan', 'pengelolaan')->name('pengelolaan');

    // Keranjang
    Route::get('/pengelolaan/keranjang', [KeranjangController::class, 'index'])->name('pengelolaan.keranjang');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');

    // Tambah buku (form)
    Route::view('/pengelolaan/tambahbuku', 'tambahbuku')->name('pengelolaan.tambahbuku');

    // Tukar Buku (dashboard swap)
    Route::get('/pengelolaan/swapbook', [SwapbookController::class, 'index'])->name('pengelolaan.swapbook');

     Route::get('/pengelolaan/mycollection', [MyCollectionController::class, 'index'])
        ->name('mycollection.index');

    // (opsional alias singkat)
    Route::get('/mycollection', fn () => redirect()->route('mycollection.index'))
        ->name('mycollection.alias');

    // Buat permintaan tukar (POST)
    Route::post('/swap/requests', [SwapbookController::class, 'store'])
        ->name('swap.store');

    // (opsional) Halaman daftar permintaan tukar
    Route::get('/swap/requests', [SwapbookController::class, 'index'])
        ->name('swap.index');


    // Profil user & Forum
    Route::get('/profil_user', [ProfilUserController::class, 'index'])->name('profil_user');
    Route::view('/forumdiscuss', 'forumdiscuss')->name('forumdiscuss');

    // ADMIN
    Route::get('/admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');
    Route::post('/admin/buku', [HomePageAdminController::class, 'store'])->name('admin.books.store');
    Route::delete('/admin/buku/{book:id_buku}', [HomePageAdminController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/admin/profil', [HomePageAdminController::class, 'profil'])->name('admin.profil');


    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
