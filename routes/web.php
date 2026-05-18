<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PaymentController;
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
Route::get('/orders', [OrderController::class, 'showForm']);

Route::get('/manage', [ManagementController::class, 'show'])->name('manage.show.dashboard');
Route::get('/manage/dashboard', [ManagementController::class, 'show'])->name('manage.show.dashboard');
Route::get('/manage/login', [LoginController::class, 'show'])->name('manage.show.login');
Route::post('/manage/performLogin', [LoginController::class, 'performLogin'])->name('manage.login');

Route::post("/payment", [PaymentController::class, "initatePayment"])->name("payment");
