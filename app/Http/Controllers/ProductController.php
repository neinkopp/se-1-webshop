<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;

class ProductController extends Controller
{

    public function show(string $productHandle)
    {
        $product = Product::where('handle', '=', $productHandle)->firstOrFail();
        $supplier = Supplier::where('supplier_name', '=', $product->supplier_name)->firstOrFail();
        $category = ProductCategory::where('category_id', '=', $product->category_id)->firstOrFail();
        $product->supplier_name = $supplier->display_name;
        $attributes = $product->attributes;
        foreach ($attributes['properties'] as $propertyName => $property) {
            $propertyDisplayName = $category->filters[$propertyName]['displayName'] ?? $propertyName;

            $attributes['properties'][$propertyName] = [
                'displayName' => $propertyDisplayName,
                'values' => $property
            ];
        }
        $product->attributes = $attributes;
        $featuredProducts = Product::limit(10)->get();

        return view('product', compact('product', 'featuredProducts'));
    }
}
