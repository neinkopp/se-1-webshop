<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Services\ResourceServices\ProductListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductListServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_filtered_product_list_returns_products(): void
    {
        Supplier::create([
            'supplier_name' => 'printful',
            'display_name' => 'Printful'
        ]);

        //comment
        
        $category = ProductCategory::create([
            'name' => 'Shirts',
            'filters' => []
        ]);

        Product::create([
            'category_id' => $category->category_id,
            'supplier_name' => 'printful',
            'name' => 'Test Shirt',
            'handle' => 'test-shirt',
            'description' => 'Desc',
            'price' => 20,
            'attributes' => []
        ]);

        $result = ProductListService::getFilteredProductList();

        $this->assertCount(1, $result['products']);
    }

    public function test_get_filtered_product_list_with_name_filter(): void
    {
        $category = ProductCategory::create([
            'name' => 'Shirts',
            'filters' => []
        ]);

        Supplier::create([
            'supplier_name' => 'printful',
            'display_name' => 'Printful'
        ]);

        Product::create([
            'category_id' => $category->category_id,
            'supplier_name' => 'printful',
            'name' => 'Blue Shirt',
            'handle' => 'blue-shirt',
            'description' => 'Desc',
            'price' => 20,
            'attributes' => []
        ]);

        $result = ProductListService::getFilteredProductList(
            null,
            null,
            null,
            'Blue'
        );

        $this->assertCount(1, $result['products']);
    }

    public function test_get_filtered_product_list_empty_result(): void
    {
        $result = ProductListService::getFilteredProductList(
            null,
            null,
            null,
            'DoesNotExist'
        );

        $this->assertCount(0, $result['products']);
    }
}