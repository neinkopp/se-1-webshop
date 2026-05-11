<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', [HomepageController::class, "show"]);

Route::get("/component-test", function () {
    return view('component-test');
});

Route::get('/products', [ProductListController::class, "show"]);

Route::get('/products/{productHandle}', [ProductController::class, "show"]);
