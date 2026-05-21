<?php

namespace Tests\Unit\Services;

use App\Models\Invoice;
use App\Models\InvoicePosition;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Services\ResourceServices\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_order_information(): void
    {
        Supplier::create([
            'supplier_name' => 'printful',
            'display_name' => 'Printful'
        ]);

        $category = ProductCategory::create([
            'name' => 'Shirts',
            'filters' => []
        ]);

        $product = Product::create([
            'category_id' => $category->category_id,
            'supplier_name' => 'printful',
            'name' => 'Shirt',
            'handle' => 'shirt',
            'description' => 'Desc',
            'price' => 30,
            'attributes' => [
                'properties' => [],
                'default_pictures' => [
                    [
                        'picture_storage_key' => 'test.png'
                    ]
                ]
            ]
        ]);

        $invoice = Invoice::create([
            'token' => 'abc123',
            'order_date' => now()
        ]);

        InvoicePosition::create([
            'invoice_id' => $invoice->invoice_id,
            'product_id' => $product->id,
            'amount' => 2,
            'price_per_unit' => 30,
            'selected_options' => [
                'properties' => []
            ]
        ]);

        $result = OrderService::getOrderInformation('abc123');

        $this->assertEquals(60, $result['totalPrice']);
    }
}