<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', [HomepageController::class, "show"]);

Route::get('/products', [ProductListController::class, "show"]);

Route::get('/products/{productHandle}', [ProductController::class, "show"]);

Route::get('/basket', [BasketController::class, "show"]);
Route::post('/putInBasket', [BasketController::class, "put"]);
Route::post('/changeBasketItem', [BasketController::class, "change"]);
