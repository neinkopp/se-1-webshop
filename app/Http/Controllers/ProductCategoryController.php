<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function getAllProductCategories(): array
    {
        $productCategories = ProductCategory::all();

        return compact('productCategories');
    }

    public function show(string $productCategoryName)
    {
        $productCategory = ProductCategory::where('name', '=', $productCategoryName, true)->firstOrFail();

        return view('product', compact('productCategory'));
    }
}
