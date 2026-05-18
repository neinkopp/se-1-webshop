<?php

namespace App\Services\ResourceServices;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\ProductCategoryController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class ProductListService
{

    public static function getFilteredProductList(?string $category = null, ?int $priceMin = null, ?int $priceMax = null, ?string $productName = null, array $filters = []):array {

        $productQuery = Product::query();
        $selectedCategory = [];

        if (ProductListService::isRequested($category)) {
            $selectedCategory = ProductCategoryController::getWithFilters($category);
            if ($selectedCategory) {
                $productQuery->where("category_id", "=", $category);
                $productQuery = ProductListService::addFilterQueries($productQuery, $selectedCategory, $filters);
            }
        }

        $productQuery = ProductListService::addPriceRangeQuery($productQuery, $priceMin, $priceMax);

        $productQuery = ProductListService::addProductNameQuery($productQuery, $productName);

        return ["products" => $productQuery->get(), "category" => $selectedCategory];
    }

    private static function isRequested(?string $value):bool {
        return $value !== null && $value !== '';
    }

    private static function addProductNameQuery(Builder $productQuery, ?string $productName = null):Builder {
        if(ProductListService::isRequested($productName)) {
            $productQuery->whereLike("name", "%".$productName."%", false);
        }
        return $productQuery;
    }

    private static function addPriceRangeQuery(Builder $productQuery, ?int $priceMin, ?int $priceMax):Builder {
        $priceRange = ProductListService::sanitizeRange($priceMin, $priceMax);

        if ($priceRange["min"] !== null) {
            $productQuery->where("price", ">=", $priceRange["min"]);
        }
        if ($priceRange["max"] !== null) {
            $productQuery->where("price", "<=", $priceRange["max"]);
        }

        return $productQuery;
    }

    private static function addFilterQueries(Builder $productQuery, ProductCategory $productCategory, array $filters = []):Builder {
        $filterNames = array_keys($productCategory["filters"]);
        for($i = 0; $i < count($filterNames); $i++) {
            $filter = $productCategory->filters[$filterNames[$i]];
            switch($filter["type"]) {
                case "select": 
                    if (array_key_exists($filterNames[$i], $filters)) {
                        $options = ProductListService::sanitizeSelection($filters[$filterNames[$i]], $filter["options"]);
                        $productQuery->where(function ($query) use ($options, $filterNames, $i) {
                            foreach ($options as $option) {
                                $query->orWhereJsonContains("attributes->properties->{$filterNames[$i]}", $option);
                            }
                        });
                    }
                    break;
                case "color":
                    if (array_key_exists($filterNames[$i], $filters)) {
                        $options = ProductListService::sanitizeColorSelection($filters[$filterNames[$i]], $filter["options"]);
                        $productQuery->where(function ($query) use ($options) {
                            foreach ($options as $option) {
                                $query->orWhereRaw(
                                    "
                                    EXISTS (
                                        SELECT 1
                                        FROM jsonb_array_elements(attributes->'properties'->'color') AS color
                                        WHERE color->>'displayName' = ?
                                    )
                                    ",
                                    [$option]
                                );
                            }
                        });
                    }
                    break;
                default: break;
            }
        }
        return $productQuery;
    }

    private static function sanitizeSelection(array $selection, array $options):array {
        return array_intersect($selection, $options);
    }

    private static function sanitizeColorSelection(array $selection, array $options):array {
        $colorOptions = array_column($options, 'displayName');
        return array_intersect($selection, $colorOptions);
    }

    /**
     * rangeMin/rangeMax ist die Range, die man bereinigen möchte
     * minValue/maxValue sind Begrenzungen, die gesetzt werden können
     * @JaroslavGruber
     */
    private static function sanitizeRange(mixed $rangeMin, mixed $rangeMax, ?int $minValue = null, ?int $maxValue = null):array {
        $sanitizedMin = is_numeric($rangeMin) ? (int)$rangeMin : null;
        $sanitizedMax = is_numeric($rangeMax) ? (int)$rangeMax : null;

        if ($sanitizedMin !== null) {
            if ($minValue !== null) {
                $sanitizedMin = $sanitizedMin < $minValue ? $minValue:$sanitizedMin;
            }
        }
        if ($sanitizedMax !== null) {
            if ($maxValue !== null) {
                $sanitizedMax = $sanitizedMax > $maxValue ? $maxValue:$sanitizedMax;
            }
            if ($sanitizedMin !== null) {
                $sanitizedMax = $sanitizedMax < $sanitizedMin ? $sanitizedMin:$sanitizedMax;
            }
        }

        return ["min" => $sanitizedMin, "max" => $sanitizedMax];
    }
}