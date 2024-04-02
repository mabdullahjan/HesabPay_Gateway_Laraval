<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WebhookController;

Route::post('/webhook', [WebhookController::class, 'handle']);


Route::get('/', function () {
    return view('welcome');
});
Route::post('/checkout/process', 'CheckoutController@checkout')->name('checkout.process');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.process');
