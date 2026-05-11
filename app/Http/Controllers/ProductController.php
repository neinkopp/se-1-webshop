<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function show(string $productHandle)
    {
        $product = Product::where('handle', '=', $productHandle, false)->firstOrFail();

        return view('product', compact('product'));
    }
}
