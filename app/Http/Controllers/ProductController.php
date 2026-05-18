<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ResourceServices\ProductService;

class ProductController extends Controller
{

    public function show(string $productHandle)
    {
        $product = Product::where('handle', '=', $productHandle)->firstOrFail();
        $product = ProductService::replaceAttributesTechnicalNamesWithDisplayNames($product);
        $product = ProductService::replaceTechnicalSupplierNameWithSupplierDisplayName($product);
        $featuredProducts = Product::limit(10)->get();

        return view('product', compact('product', 'featuredProducts'));
    }
}
