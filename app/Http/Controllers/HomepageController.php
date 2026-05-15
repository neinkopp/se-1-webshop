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
        $featuredProducts = Product::limit(10)->get();
        return view('homepage', compact(
            'products',
            'categories',
            'featuredProducts'
        ));
    }
}
