<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', [HomepageController::class, "show"]);

Route::get('/products', [ProductListController::class, "show"]);

Route::get('/products/{productHandle}', [ProductController::class, "show"]);

Route::get('/basket', [BasketController::class, "show"])->name('basket.show');
Route::post('/putInBasket', [BasketController::class, "put"]);
Route::post('/changeBasketItem', [BasketController::class, "change"]);
Route::post('/basket/remove', [BasketController::class, 'remove'])->name('basket.remove');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/orders/{token}', [OrderController::class, 'show'])->name('orders.show');
