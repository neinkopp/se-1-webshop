<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function show(string $productHandle)
    {
        $product = Product::where('handle', '=', $productHandle, false)->firstOrFail();
        $featuredProducts = Product::limit(10)->get();

        return view('product', compact('product', 'featuredProducts'));
    }
}
