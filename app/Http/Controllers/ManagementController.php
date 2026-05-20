<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeCategoryRequest;
use App\Http\Requests\ChangeProductPicturesRequest;
use App\Http\Requests\ChangeProductRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\ManagementShowRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Services\ResourceServices\ManagementCategoryService;
use App\Services\ResourceServices\ManagementProductService;
use App\Services\ResourceServices\ProductCategoryService;
use App\Services\ResourceServices\ProductService;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function show(ManagementShowRequest $request) {
        $dashboardDetails = ManagementCategoryService::getDashboardDetails();
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
        $category = is_numeric($category) ? ProductCategory::where('category_id',$category)->firstOrFail(): null;
        return view(
            'management-category',
            compact('category')
        );
    }

    public function createCategory(CreateCategoryRequest $request) {
        $category = ManagementCategoryService::createCategory($request->validated());
        return response()->json([
            'status' => 'success',
            'category' => $category,
        ]);
    }

    public function changeCategory(ChangeCategoryRequest $request) {
        $validated = $request->validated();

        $category = ProductCategory::findOrFail(
            $validated['category_id']
        );

        $category = ManagementCategoryService::updateCategory(
            $category,
            $validated
        );

        return response()->json([
            'status' => 'success',
            'category' => $category,
        ]);
    }

    public function deleteCategory(string $category, DeleteCategoryRequest $request) {
        $category = ProductCategory::where('category_id',$category)->firstOrFail();
        try {
            ManagementCategoryService::deleteCategory(
                $category
            );
            return response()->json([
                'status' => 'success',
                'message' => 'success'
            ], 201);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function showProducts(ManagementShowRequest $request) {
        $products = Product::all();
        return view('management-products', compact('products'));
    }

    public function showProduct(string $productHandle)
    {
        $product = $productHandle === 'new' ? null : Product::where('handle', $productHandle)->firstOrFail();

        $categories = ProductCategory::all();
        $suppliers = Supplier::all();

        return view(
            'management-product',
            compact('product', 'categories', 'suppliers')
        );
    }

    public function showProductAttributes(string $productHandle)
    {
        $product = Product::where('handle', $productHandle)->firstOrFail();
        $product = ProductService::replaceAttributesTechnicalNamesWithDisplayNames($product);
        $product = ProductService::removeColorAttribute($product);
        return view(
            'management-product-attributes',
            compact('product')
        );
    }

    public function showProductPictures(string $productHandle)
    {
        $product = Product::where('handle', $productHandle)->firstOrFail();

        return view(
            'management-product-pictures',
            compact('product')
        );
    }

    public function createProduct(CreateProductRequest $request) {
        try {
            $product = ManagementProductService::create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'success',
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function changeProduct(ChangeProductRequest $request) {
        try {
            $validated = $request->validated();
            $product = Product::where('handle',$validated['handle'])->firstOrFail();

            ManagementProductService::update($product, $validated);

            return response()->json([
                'status' => 'success',
                'message' => 'success',
            ], 201);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function changeProductAttributes(Request $request) {
        try {
            $data = $request->all();
            $product = Product::where('handle', $data['handle'])->firstOrFail();
            ManagementProductService::updateAttributes($product, $data??[]);

            return response()->json(['status' => 'success','message' => 'success'], 201);

        } catch(\Throwable $e) {
            return response()->json(['status' => 'failure', 'message' => $e->getMessage()], 500);
        }
    }

    public function changeProductPictures(ChangeProductPicturesRequest $request) {
        try {

            $product = Product::where('handle', $request->input('handle'))->firstOrFail();

            ManagementProductService::updatePictures($product, $request);
            return response()->json([
                'status' => 'success',
                'message' => 'success'
            ], 201);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
