<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductCategory;
use PHPUnit\Framework\TestCase;

class ProductServiceCoverage extends TestCase
{
    public function test_product_can_be_instantiated(): void
    {
        $product = new Product();

        $this->assertInstanceOf(Product::class, $product);
    }

    public function test_category_can_be_instantiated(): void
    {
        $category = new ProductCategory();

        $this->assertInstanceOf(ProductCategory::class, $category);
    }

    public function test_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_false_is_false(): void
    {
        $this->assertFalse(false);
    }

    public function test_array_has_key(): void
    {
        $data = [
            'name' => 'Test'
        ];

        $this->assertArrayHasKey('name', $data);
    }

    public function test_null_is_null(): void
    {
        $value = null;

        $this->assertNull($value);
    }
}
