<?php

namespace App\Services\ResourceServices;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductCategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(){}

    public static function getCategoryWithFilters(mixed $category_id):?ProductCategory {
        $category = ProductCategory::where("category_id", "=", $category_id)->first();
        if ($category) {
            $categoryFilters = ProductCategoryService::getCategoryFilters($category);
            $category->filters = $categoryFilters;
            return $category;
        }
        return null;
    }

    private static function getCategoryFilters(ProductCategory $category):array {
        $categoryFilters = $category->filters;

        $products = Product::where('category_id', '=', $category->category_id)->get("attributes");

        $categoryFiltersWithOptions = ProductCategoryService::appendOptions($categoryFilters, $products);
        return $categoryFiltersWithOptions;
    }

    private static function appendOptions(array $categoryFilters, Collection $products): array {
        for($i = 0; $i < count($categoryFilters); $i++) {
            $filterName = array_keys($categoryFilters)[$i];
            $filterOptions = ProductCategoryService::getFilterOptionsFromProducts($filterName, $products);
            $categoryFilters[$filterName]["options"] = $filterOptions;
        }
        return $categoryFilters;
    }

    private static function getFilterOptionsFromProducts(string $filterName, Collection $products):array {
        $filterOptions = [];
        foreach($products as $product) {
            foreach ($product->attributes as $productAttribute) {
                $propertyNames = array_keys($productAttribute);
                for($j = 0; $j < count($productAttribute); $j++) {
                    $propertyName = $propertyNames[$j];
                    if ($propertyName == $filterName) {
                        $options = $productAttribute[$propertyName];
                        foreach($options as $option) {
                            if ($propertyName == 'color') {
                                if (!in_array($option['displayName'], array_column($filterOptions, 'displayName'))) {
                                    $filterOptions[] = ['displayName' => $option['displayName'], 'value' => $option['value']];
                                }
                            } else {
                                if (!in_array($option, $filterOptions)) {
                                    $filterOptions[] = $option;
                                }
                            }
                        }
                    }
                } 
            }
        }
        return $filterOptions;
    }
}
