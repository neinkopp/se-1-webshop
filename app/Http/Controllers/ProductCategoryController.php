<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductCategoryController extends Controller
{
    public static function getWithFilters(string $category_id):?ProductCategory {

        $category = ProductCategory::where("category_id", "=", $category_id, false)->first();

        if ($category) {

            $categoryFilters = $category->filters;

            $products = Product::where('category_id', '=', 1, false)->get("attributes");

            for($i = 0; $i < count($categoryFilters); $i++) {
                $filterName = array_keys($categoryFilters)[$i];
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
                $categoryFilters[$filterName]["options"] = $filterOptions;
            }
            $category->filters = $categoryFilters;
            return $category;
        }
        return null;
    }
}
