<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfilUserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MyCollectionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ManajemenAdminController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SwapbookController;
use App\Http\Controllers\KategoriController;




// ----------------------
// HALAMAN AWAL
// ----------------------
Route::get('/', fn() => view('home'));
Route::get('/beranda', fn() => view('home'))->name('home');
Route::get('/home', fn() => view('home'))->name('home');
Route::get('/kontak', fn() => view('contact'))->name('contact');




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
  Route::get('/pengelolaan', function () {
    $user = Auth::user();
    return view('pengelolaan', compact('user'));
  })->name('pengelolaan');
});


// =========================
// Tambah buku
// =========================
Route::get('/pengelolaan/tambahbuku', [BukuController::class, 'create'])
    ->name('pengelolaan.tambahbuku');

// =========================
// BUKU CONTROLLER
// =========================
Route::post('/buku/tambah', [BukuController::class, 'store'])->name('buku.store');
Route::delete('/buku/hapus/{book}', [BukuController::class, 'destroy'])->name('buku.destroy');

// =========================
// KATEGORI CONTROLLER
// =========================

Route::post('/kategori/tambah', [KategoriController::class, 'store'])
    ->middleware('auth')
    ->name('kategori.store');




Route::view('/pengelolaan/swapbook', 'swapbook')->name('pengelolaan.swapbook');

// =========================
// KERANJANG (AKSI)
// =========================
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');
Route::post('/keranjang/tambah', [KeranjangController::class, 'add'])->name('cart.add');
Route::delete('/keranjang/hapus/{id_buku}', [KeranjangController::class, 'remove'])->name('cart.remove');
Route::get('/pengelolaan/keranjang', [KeranjangController::class, 'index'])->name('pengelolaan.keranjang');
Route::post('/keranjang/tambah-qty/{id_buku}', [KeranjangController::class, 'increase'])->name('cart.increase');
Route::post('/keranjang/kurang-qty/{id_buku}', [KeranjangController::class, 'decrease'])->name('cart.decrease');



// =========================
// PROFIL USER
// =========================
Route::get('/profil_user', [ProfilUserController::class, 'index'])->name('profil_user');
Route::put('/profil_user/update', [ProfilUserController::class, 'update'])->name('profil_user.update');


// =========================
//  ADMIN: Profil Admin
// =========================
Route::get('/admin/profil', [HomePageAdminController::class, 'profil'])->name('admin.profil');
Route::put('/admin/profil/update', [HomePageAdminController::class, 'updateProfil'])->name('admin.profil.update');

Route::get('/profil_admin', [ProfilUserController::class, 'index'])->name('profil_admin');
Route::put('/profil_admin/update', [ProfilUserController::class, 'update'])->name('profil_admin.update');


// My Collection (pilih buku milik sendiri untuk ditukar)
Route::get('/pengelolaan/mycollection', [MyCollectionController::class, 'index'])->name('mycollection.index');
Route::get('/mycollection', [MyCollectionController::class, 'index'])->name('mycollection.index');

Route::view('/forumdiscuss', 'forumdiscuss')->name('forumdiscuss');

// =========================
// ADMIN: Dashboard buku
// =========================
Route::get('/admin', [HomePageAdminController::class, 'index'])->name('homepage_admin');
Route::post('/admin/tambah', [HomePageAdminController::class, 'store'])->name('homepage_admin.store');
Route::delete('/admin/buku/{book:id_buku}', [HomePageAdminController::class, 'destroy'])->name('homepage_admin.destroy');

// =========================
// ADMIN: Manajemen Akun & Role
// =========================
Route::prefix('manajemen_admin')->group(function () {

  Route::get('/', [ManajemenAdminController::class, 'index'])->name('manajemen_admin');

  Route::get('/edit/{id}', [ManajemenAdminController::class, 'edit'])->name('manajemen_admin.edit');
  Route::put('/update/{id}', [ManajemenAdminController::class, 'update'])->name('manajemen_admin.update');

  Route::delete('/delete/{id}', [ManajemenAdminController::class, 'destroy'])->name('manajemen_admin.delete');
  Route::get('/role/{id}', [ManajemenAdminController::class, 'editRole'])->name('manajemen_admin.role');
  Route::put('/role/update/{id}', [ManajemenAdminController::class, 'updateRole'])->name('manajemen_admin.role.update');
});




// =========================
// LOGOUT
// =========================
Route::middleware('auth')->group(function () {
  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ===============================================
// FORUM DISCUSS ROUTES
// ===============================================
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


// ===============================================
// RIWAYAT PEMBELIAN (PURCHASE HISTORY)
// ===============================================
Route::get('/purchase', [PurchaseController::class, 'index'])
  ->middleware('auth')
  ->name('purchase.index');


// =========================
// ADMIN: Manajemen Akun & Role
// =========================
Route::prefix('manajemen_admin')->group(function () {

  Route::get('/', [ManajemenAdminController::class, 'index'])->name('manajemen_admin');

  Route::get('/edit/{id}', [ManajemenAdminController::class, 'edit'])->name('manajemen_admin.edit');
  Route::put('/update/{id}', [ManajemenAdminController::class, 'update'])->name('manajemen_admin.update');

  Route::delete('/delete/{id}', [ManajemenAdminController::class, 'destroy'])->name('manajemen_admin.delete');

  Route::get('/role/{id}', [ManajemenAdminController::class, 'editRole'])->name('manajemen_admin.role');
  Route::put('/role/update/{id}', [ManajemenAdminController::class, 'updateRole'])->name('manajemen_admin.role.update');
});

// =========================
// MIDTRANS
// =========================
// tombol beli langsung (1 buku)
Route::post('/buy-now/{bookId}', [MidtransController::class, 'buyNow'])
  ->name('midtrans.buyNow');

// checkout keranjang atau banyak item
Route::post('/checkout', [MidtransController::class, 'createCheckout'])
  ->name('midtrans.checkout');


// ----------------------------
    // SWAPBOOK
    // ----------------------------

    // Halaman utama permintaan tukar buku (sidebar "Permintaan Tukar Buku")
    Route::get('/pengelolaan/swapbook', [SwapbookController::class, 'index'])
        ->name('swap.index');

    // Form dari "Koleksi Buku Saya" untuk mengirim permintaan tukar
    Route::post('/pengelolaan/swapbook', [SwapbookController::class, 'store'])
        ->name('swap.store');

    // Alias lama: /swapbook -> redirect ke halaman di atas (biar kalau ada URL lama, tetap aman)
    Route::get('/swapbook', fn () => redirect()->route('swap.index'))
        ->name('swap.alias');

    // Incoming request: terima / tolak
    Route::patch('/swap/requests/{swap}/accept', [SwapbookController::class, 'accept'])
        ->name('swap.accept');

    Route::patch('/swap/requests/{swap}/reject', [SwapbookController::class, 'reject'])
        ->name('swap.reject');

