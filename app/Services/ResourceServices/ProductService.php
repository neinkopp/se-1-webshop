<?php

namespace App\Services\ResourceServices;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct(){}

    public static function replaceAttributesTechnicalNamesWithDisplayNames(Product $product):Product {
        $attributes = $product->attributes;
        $category = ProductCategory::where('category_id', '=', $product->category_id)->firstOrFail();

        foreach ($attributes['properties'] as $propertyName => $property) {
            $propertyDisplayName = $category->filters[$propertyName]['displayName'] ?? $propertyName;

            $attributes['properties'][$propertyName] = [
                'displayName' => $propertyDisplayName,
                'values' => $property
            ];
        }
        $product->attributes = $attributes;
        return $product;
    }

    public static function replaceTechnicalSupplierNameWithSupplierDisplayName(Product $product):Product {
        $supplier = Supplier::where('supplier_name', '=', $product->supplier_name)->firstOrFail();
        $product->supplier_name = $supplier->display_name;
        return $product;
    }

    public static function removeColorAttribute(Product $product):Product {
        $attributes = $product->attributes;    
        unset($attributes['properties']['color']);
        $product->attributes = $attributes;
        return $product;
    }

    
}
