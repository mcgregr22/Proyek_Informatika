<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\HomePageAdminController;

// ----------------------
// HALAMAN AWAL (PUBLIC)
// ----------------------
Route::get('/', fn () => view('welcome'));

Route::get('/home', fn () => view('home'))->name('home');




// ----------------------
// TAMU (BELUM LOGIN)
// ----------------------
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegistrasiController::class, 'show'])->name('register.show');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
Route::get('/admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');

// ----------------------
// SUDAH LOGIN (AUTH)
// ----------------------
Route::middleware('auth')->group(function () {

    // =========================
    // HOMEPAGE USER
    // =========================
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
    Route::get('/buku/{id}', [HomepageController::class, 'show'])->name('buku.show');

    // =========================
    // PENGELOLAAN (LAYOUT + MENU)
    // =========================
    Route::view('/pengelolaan', 'pengelolaan')->name('pengelolaan');

    // Keranjang DI DALAM layout pengelolaan
    Route::get('/pengelolaan/keranjang', [KeranjangController::class, 'index'])
        ->name('pengelolaan.keranjang'); // <- sesuai dengan yang dipanggil di layout
       

        Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');
        Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
        Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');


    // Tambah Buku (view placeholder, sesuaikan file view-mu)
    Route::view('/pengelolaan/tambahbuku', 'tambahbuku')->name('pengelolaan.tambahbuku');

    // Tukar Buku
    // Jika view kamu di resources/views/swapbook.blade.php -> pakai 'swapbook'
    // Jika view-nya di resources/views/pengelolaan/swapbook.blade.php -> ganti ke 'pengelolaan.swapbook'
    Route::view('/pengelolaan/swapbook', 'swapbook')->name('pengelolaan.swapbook');

    // =========================
    // KERANJANG (AKSI)
    // =========================
    Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'remove'])->name('cart.remove');

    // =========================
    // PROFIL USER
    // =========================
    Route::get('/profil_user', [ProfilUserController::class, 'index'])->name('profil_user');

    // =========================
    // HALAMAN TAMBAHAN
    // =========================
    Route::view('/pengelolaan/mycollection', 'pengelolaan')
    ->name('pengelolaan.mycollection');
    Route::view('/forumdiscuss', 'forumdiscuss')->name('forumdiscuss');

    // =========================
    // ADMIN (HomePageAdminController)
    // =========================
    // Dashboard admin (dipakai oleh controller saat redirect ->route('homepage_admin'))
    Route::get('/admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');

    // Simpan buku baru (form tambah buku admin)
    Route::post('/admin/buku', [HomePageAdminController::class, 'store'])->name('admin.books.store');

    // Hapus buku (pakai route model binding; jika PK tabelmu 'id_buku', pakai {book:id_buku})
    Route::delete('/admin/buku/{book:id_buku}', [HomePageAdminController::class, 'destroy'])->name('admin.books.destroy');

    // (opsional) Profil admin
    Route::get('/admin/profil', [HomePageAdminController::class, 'profil'])->name('admin.profil');

    // ----------------------
    // HOMEPAGE ADMIN
    // ----------------------
    Route::get('/homepage_admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');
    Route::post('/homepage_admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');
    Route::delete('/homepage_admin/hapus/{id}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

    // =========================
    // LOGOUT
    // =========================
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// FORUM DISCUSS ROUTES
use App\Http\Controllers\ForumController;

// Grup Rute Forum yang memerlukan otentikasi
Route::middleware(['auth'])->prefix('forumdiscuss')->group(function () {
    // Rute Tampilan (GET)
    // URI: /forumdiscuss
    Route::get('/', [ForumController::class, 'index'])->name('forum.index');
    
    // Rute Simpan Post Baru (POST)
    // URI: /forumdiscuss/post
    Route::post('/post', [ForumController::class, 'store'])->name('forum.post.store');

    // Rute Menyimpan Komentar Baru (POST)
    // PERBAIKAN: Nama rute diubah dari 'forum.comment.store' menjadi 'forum.comment'
    // URI: /forumdiscuss/{id_post}/comment
    Route::post('/{id_post}/comment', [ForumController::class, 'storeComment'])->name('forum.comment');
});
// =========================
// PURCHASE DETAIL ROUTES
use App\Http\Controllers\PurchaseController;

Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.detail');