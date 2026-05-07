<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getAllProducts(): array
    {
        $products = Product::all();

        return compact('products');
    }

    public function show(string $handle)
    {
        $product = Product::where('handle', '=', $handle, true)->firstOrFail();

        return view('product', compact('product'));
    }
}
