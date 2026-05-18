<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ResourceServices\ProductListService;
use Illuminate\Http\Request;

class ProductListController extends Controller {
    
    public function show(Request $request) {
        $featuredProducts = Product::limit(10)->get();
        $filteredProductsAndCategory = [];
        
        try {
            $filteredProductsAndCategory = ProductListService::getFilteredProductList($request->query("category")??null, $request->query("priceMin")??null, $request->query("priceMax")??null, $request->query("productName")??null, $request->all());
            $selectedCategory = $filteredProductsAndCategory["category"];
            $products = $filteredProductsAndCategory["products"];
        } catch(\Exception $e) {
            return redirect('/');
        }

        $categories = ProductCategory::all();
        
        return view("product-list", compact(
            "products",
            "categories",
            "selectedCategory",
            "featuredProducts"
        ));
    }
}
