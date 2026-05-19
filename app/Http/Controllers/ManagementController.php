<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeCategoryRequest;
use App\Http\Requests\ChangeProductRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\ManagementShowRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ResourceServices\ManagementService;

class ManagementController extends Controller
{
    public function show(ManagementShowRequest $request) {
        $dashboardDetails = ManagementService::getDashboardDetails();
        $orderCount = $dashboardDetails["orderCount"];
        $soldProductsCount = $dashboardDetails["soldProductsCount"];
        $mostSoldProductName = $dashboardDetails["mostSoldProductName"];
        $lastWeekSalesCount = $dashboardDetails["lastWeekSalesCount"];
        return view('management-dashboard', compact('orderCount', 'soldProductsCount', 'mostSoldProductName', 'lastWeekSalesCount'));
    }

    public function showCategories(ManagementShowRequest $request) {
        $categories = ProductCategory::all();
        return view('management-categories', compact('categories'));
    }

    public function showCategory(string $category, ManagementShowRequest $request) {
        $category = ProductCategory::where("category_id", "=", $category)->firstOrFail();
        return view('management-category', compact('category'));
    }

    public function createCategory(CreateCategoryRequest $request) {
        $requestData = $request->validated();
        return response()->json([
            'status' => 'failure',
            'message' => 'Not implemented'
        ], 500);
    }

    public function changeCategory(ChangeCategoryRequest $request) {
        $requestData = $request->validated();
        return response()->json([
            'status' => 'failure',
            'message' => 'Not implemented'
        ], 500);
    }

    public function deleteCategory(string $category, DeleteCategoryRequest $request) {
        return response()->json([
            'status' => 'failure',
            'message' => 'Not implemented'
        ], 500);
    }

    public function showProducts(ManagementShowRequest $request) {
        $products = Product::all();
        return view('management-products', compact('products'));
    }

    public function showProduct(string $productHandle, ManagementShowRequest $request) {
        $product = Product::where("handle", "=", $productHandle)->firstOrFail();
        return view('management-product', compact('product'));
    }

    public function createProduct(CreateProductRequest $request) {
        $requestData = $request->validated();
        return response()->json([
            'status' => 'failure',
            'message' => 'Not implemented'
        ], 500);
    }

    public function changeProduct(ChangeProductRequest $request) {
        $requestData = $request->validated();
        return response()->json([
            'status' => 'failure',
            'message' => 'Not implemented'
        ], 500);
    }

    public function deleteProduct(string $productHandle, DeleteProductRequest $request) {
        return response()->json([
            'status' => 'failure',
            'message' => 'Not implemented'
        ], 500);
    }
}
