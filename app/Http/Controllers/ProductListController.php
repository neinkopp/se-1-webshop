<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductListController extends Controller {
    
    public function show(Request $request) {

        $productQuery = Product::query();

        $selected_category = [];

        if ($request->filled('category')) {
            $selected_category = ProductCategoryController::getWithFilters($request->query("category"));
            if ($selected_category) {
                $productQuery->where("category_id", "=", $request->query("category"));
                $filterNames = array_keys($selected_category["filters"]);
                for($i = 0; $i < count($filterNames); $i++) {
                    $filter = $selected_category->filters[$filterNames[$i]];
                    switch($filter["type"]) {
                        case "select": 
                            if ($request->filled($filterNames[$i])) {
                                $options = $this->sanitizeSelection($request->query($filterNames[$i]), $filter["options"]);
                                $productQuery->where(function ($query) use ($options, $filterNames, $i) {
                                    foreach ($options as $option) {
                                        $query->orWhereJsonContains("attributes->properties->{$filterNames[$i]}", $option);
                                    }
                                });
                            }
                            break;
                        case "color":
                            if ($request->filled($filterNames[$i])) {
                                $options = $this->sanitizeColorSelection($request->query($filterNames[$i]), $filter["options"]);
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
            }
        }

        $priceRange = $this->sanitizeRange($request->query("priceMin"), $request->query("priceMax"));

        if ($priceRange["min"] !== null) {
            $productQuery->where("price", ">=", $priceRange["min"]);
        }
        if ($priceRange["max"] !== null) {
            $productQuery->where("price", "<=", $priceRange["max"]);
        }

        if($request->filled("productName")) {
            $productQuery->whereLike("name", "%".$request->query("productName")."%", false, false, false);
        }

        $featuredProducts = Product::limit(10)->get();
        
        try {
            $products = $productQuery->get();
        } catch(\Exception $e) {
            dd([
                'message' => $e->getMessage(),
                'sql' => $productQuery->toRawSql(),
                'bindings' => $productQuery->getBindings(),
            ]);
        }

        $categories = ProductCategory::all();
        
        return view("product-list", compact(
            "products",
            "categories",
            "selected_category",
            "featuredProducts"
        ));
    }

    /**
     * rangeMin/rangeMax ist die Range, die man bereinigen möchte
     * minValue/maxValue sind Begrenzungen, die gesetzt werden können
     * @JaroslavGruber
     */
    private function sanitizeRange(mixed $rangeMin, mixed $rangeMax, ?int $minValue = null, ?int $maxValue = null):array {
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

    private function sanitizeSelection(array $selection, array $options):array {
        return array_intersect($selection, $options);
    }

    private function sanitizeColorSelection(array $selection, array $options):array {
        $colorOptions = array_column($options, 'displayName');
        return array_intersect($selection, $colorOptions);
    }
}
