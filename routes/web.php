<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/debug-clear-cart', function () {
    session()->forget('cart');
    return 'cart cleared';
});


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'detail'])
    ->name('product.detail');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add']);

// Cart routes
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');

// order routes
Route::get('/checkout', [
    \App\Http\Controllers\OrderController::class,
    'checkout'
])
->name('order.checkout');

Route::post(
    '/order',
    [
        \App\Http\Controllers\OrderController::class,
        'store'
    ]
)->name('order.store');

Route::get('/order/success/{id}', [
        \App\Http\Controllers\OrderController::class,
        'success'
])->name('order.success');