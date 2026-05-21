<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Services\ResourceServices\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_replace_attributes_technical_names_with_display_names(): void
    {
        $category = ProductCategory::create([
            'name' => 'Shirts',
            'filters' => [
                'size' => [
                    'type' => 'select',
                    'displayName' => 'Größe'
                ]
            ]
        ]);

        Supplier::create([
            'supplier_name' => 'printful',
            'display_name' => 'Printful Inc.'
        ]);

        $product = Product::create([
            'category_id' => $category->category_id,
            'supplier_name' => 'printful',
            'name' => 'Shirt',
            'handle' => 'shirt',
            'description' => 'Desc',
            'price' => 10,
            'attributes' => [
                'properties' => [
                    'size' => ['M']
                ]
            ]
        ]);

        $product = ProductService::replaceAttributesTechnicalNamesWithDisplayNames($product);

        $this->assertEquals(
            'Größe',
            $product->attributes['properties']['size']['displayName']
        );
    }

    public function test_remove_color_attribute(): void
    {
        $product = new Product([
            'attributes' => [
                'properties' => [
                    'color' => [],
                    'size' => ['M']
                ]
            ]
        ]);

        $product = ProductService::removeColorAttribute($product);

        $this->assertArrayNotHasKey(
            'color',
            $product->attributes['properties']
        );
    }

    public function test_replace_supplier_name(): void
    {
        Supplier::create([
            'supplier_name' => 'printful',
            'display_name' => 'Printful Inc.'
        ]);

        $category = ProductCategory::create([
            'name' => 'Shirts',
            'filters' => [
                'size' => [
                    'type' => 'select',
                    'displayName' => 'Größe'
                ]
            ]
        ]);

        $product = new Product([
            'supplier_name' => 'printful',
            'category_id' => $category->category_id
        ]);

        $product = ProductService::replaceTechnicalSupplierNameWithSupplierDisplayName($product);

        $this->assertEquals(
            'Printful Inc.',
            $product->supplier_name
        );
    }
}