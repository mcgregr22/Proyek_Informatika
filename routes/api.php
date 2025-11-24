<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

// Midtrans Notification / Callback
Route::post('/midtrans/notification', [MidtransController::class, 'notification'])
    ->name('midtrans.notification');

Route::post('/midtrans/callback', [MidtransController::class, 'callback'])
    ->name('midtrans.callback');
