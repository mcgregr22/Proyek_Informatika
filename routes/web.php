<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\ManajemenAdminController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIC (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));

Route::middleware('guest')->group(function () {
    // ✅ Register Routes
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    // ✅ Login Routes (final, tidak duplikat)
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');
});


// Homepage umum
Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

/*
|--------------------------------------------------------------------------
| PROTEKSI LOGIN (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HOMEPAGE USER
    |--------------------------------------------------------------------------
    */
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    /*
    |--------------------------------------------------------------------------
    | KERANJANG
    |--------------------------------------------------------------------------
    */
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');

    /*
    |--------------------------------------------------------------------------
    | MENU PENGELOLAAN (Layout)
    |--------------------------------------------------------------------------
    */
    Route::view('/pengelolaan', 'pengelolaan')->name('pengelolaan');
    Route::get('/pengelolaan/keranjang', [KeranjangController::class, 'index'])->name('pengelolaan.keranjang');

    Route::view('/pengelolaan/tambahbuku', 'tambahbuku')->name('pengelolaan.tambahbuku');
    Route::view('/pengelolaan/swapbook', 'swapbook')->name('pengelolaan.swapbook');

    /*
    |--------------------------------------------------------------------------
    | HALAMAN TAMBAHAN USER
    |--------------------------------------------------------------------------
    */
    Route::get('/profil_user', [ProfilUserController::class, 'index'])->name('profil_user');
    Route::view('/mycollection', 'mycollection')->name('mycollection');
    Route::view('/forumdiscuss', 'forumdiscuss')->name('forumdiscuss');

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Dashboard Buku (HomePageAdminController)
    |--------------------------------------------------------------------------
    */
    Route::get('/admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');

    Route::post('/admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');

    Route::delete('/admin/buku/{book:id_buku}', [HomePageAdminController::class, 'destroy'])
        ->name('homepage_admin.destroy');

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Profil Admin
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/profil', [HomePageAdminController::class, 'profil'])->name('admin.profil');
    Route::put('/admin/profil/update', [HomePageAdminController::class, 'updateProfil'])->name('admin.profil.update');

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Manajemen Akun & Role
    |--------------------------------------------------------------------------
    */
    Route::prefix('manajemen_admin')->group(function () {

        Route::get('/', [ManajemenAdminController::class, 'index'])->name('manajemen_admin');

        Route::get('/edit/{id}', [ManajemenAdminController::class, 'edit'])->name('manajemen_admin.edit');
        Route::put('/update/{id}', [ManajemenAdminController::class, 'update'])->name('manajemen_admin.update');

        Route::delete('/delete/{id}', [ManajemenAdminController::class, 'destroy'])->name('manajemen_admin.delete');

        Route::get('/role/{id}', [ManajemenAdminController::class, 'editRole'])->name('manajemen_admin.role');
        Route::put('/role/update/{id}', [ManajemenAdminController::class, 'updateRole'])->name('manajemen_admin.role.update');
    });

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
