<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductListController extends Controller {
    
    public function show(array $filters = [], string $productCategoryId = "") {
        $products = Product::all();
        return view('welcome', compact(
            'products'
        ));
    }
}
