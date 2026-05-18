<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Services\ResourceServices\ProductCategoryService;

class ProductCategoryController extends Controller
{
    public static function getWithFilters(mixed $category_id):?ProductCategory {
        return ProductCategoryService::getCategoryWithFilters($category_id);
    }
}
