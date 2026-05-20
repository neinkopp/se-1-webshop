<?php

namespace App\Services\ResourceServices;

use App\Http\Requests\ChangeProductPicturesRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\ResourceServices\ProductImageService;

class ManagementProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public static function create(array $data): Product {
        if(Product::where('handle', $data['handle'])->exists()) {
            throw new \Exception('Dieser technische Name ist bereits vergeben.');
        }
        if(!ProductCategory::where('category_id', $data['category_id'])->exists()) {
            throw new \Exception('Die angegebene Kategorie ist ungültig.');
        }
        if(!Supplier::where('supplier_name', $data['supplier_name'])->exists()) {
            throw new \Exception('Der angegebene Printshop existiert nicht');
        }
        return Product::create([
            'category_id' => $data['category_id'],
            'supplier_name' => $data['supplier_name'],
            'name' => $data['name'],
            'handle' => $data['handle'],
            'description' => $data['description'],
            'price' => $data['price'],
            'attributes' => [
                'properties' => ManagementProductService::getEmptyPropertiesList($data['category_id']),
                'default_pictures' => [],
                'assets' => []
            ]
        ]);
    }

    private static function getEmptyPropertiesList(int $category_id):array {
        $category = ProductCategory::where("category_id", $category_id)->firstOrFail();
        $properties = [];
        $categoryNames = array_keys($category->filters);
        for($i = 0; $i < count($category->filters); $i++) {
            $categoryName = $categoryNames[$i];
            $properties[$categoryName] = [];
        }
        return $properties;
    }

    public static function update(Product $product, array $data) {
        if(Product::where('handle', $data['handle'])->exists() && $product->handle !== $data["handle"]) {
            throw new \Exception('Dieser technische Name ist bereits vergeben.');
        }
        if(!ProductCategory::where('category_id', $data['category_id'])->exists()) {
            throw new \Exception('Die angegebene Kategorie ist ungültig.');
        }
        if($product->category_id != $data['category_id']) {
            $product->category_id = $data['category_id'];
            $product->attributes = [
                'properties' => ManagementProductService::getEmptyPropertiesList($data['category_id']),
                'default_pictures' => [],
                'assets' => []
            ];
        }
        if(!Supplier::where('supplier_name', $data['supplier_name'])->exists()) {
            throw new \Exception('Der angegebene Printshop existiert nicht');
        }
        $product->supplier_name = $data['supplier_name'];
        $product->name = $data['name'];
        $product->handle = $data['handle'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->save();

    }

    public static function updateAttributes(Product $product, array $data): Product {
        $attributes = $product->attributes ?? [];

        $properties = $attributes['properties'] ?? [];

        $category = ProductCategory::findOrFail($product->category_id);

        foreach ($category->filters as $key => $filter) {
            if ($key === 'color' || $key === 'handle') {
                continue;
            }
            $raw = $data[$key] ?? '';

            $values =
                collect(
                    explode(',', $raw)
                )
                ->map(fn ($value) => trim($value))
                ->filter()
                ->values()
                ->toArray();

            $properties[$key] = $values;
        }

        $attributes['properties'] = $properties;

        $product->attributes = $attributes;

        $product->save();

        return $product->fresh();
    }

    public static function updatePictures(Product $product, ChangeProductPicturesRequest $request): Product {
        $attributes = $product->attributes ?? [];

        $attributes['default_pictures'] = ProductImageService::storeDefaultPictures($request, $attributes['default_pictures'] ?? []);

        /*
        |--------------------------------------------------------------------------
        | COLORS
        |--------------------------------------------------------------------------
        */

        $attributes['properties']['color'] =
            ProductImageService::storeColorPictures(

                $request,

                $attributes['properties']['color']
                ?? []
            );

        /*
        |--------------------------------------------------------------------------
        | ASSETS
        |--------------------------------------------------------------------------
        */

        $attributes['assets'] =
            ProductImageService::storeAssets(

                $request,

                $attributes['assets']
                ?? []
            );

        /*
        |--------------------------------------------------------------------------
        | SAVE
        |--------------------------------------------------------------------------
        */

        $product->attributes =
            $attributes;

        $product->save();

        return $product->fresh();
    }
}
