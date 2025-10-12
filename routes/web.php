<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

use Illuminate\Http\Request;

Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    if ($email === '123@gmail.com' && $password === '1234') {
        return redirect('/homepage');
    } else {
        return back()->with('error', 'Email atau password salah!');
    }
});


Route::get('/homepage', function () {
    return view('homepage');
});


Route::get('/swapbook', function () {
    return view('swapbook');
});
Route::get('/keranjang', function () {
    return view('keranjang');
});

Route::get('/mycollection', function () {
    return view('mycollection');
});

Route::get('/forumdiscuss', function () {
    return view('forumdiscuss');
});

Route::get('/profil_admin', function () {
    return view('profil_admin');
});

Route::get('/profil_user', function () {
    return view('profil_user');
});

Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});
Route::get('/manajemen_admin', function () {
    return view('manajemen_admin');
});

Route::get('/checkout', function () {
    return view('checkout');
});