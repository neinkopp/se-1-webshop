<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class HomepageController extends Controller
{
    public function show() {
        $products = Product::all();
        $categories = ProductCategory::all();
        return view('homepage', compact(
            'products',
            'categories'
        ));
    }
}
