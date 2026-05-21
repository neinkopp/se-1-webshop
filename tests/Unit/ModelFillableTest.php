<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\InvoicePosition;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ShoppingCartPosition;
use App\Models\Supplier;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class ModelFillableTest extends TestCase
{
    public function test_product_has_fillable()
    {
        $product = new Product();

        $this->assertIsArray($product->getFillable());
    }

    public function test_product_category_has_fillable()
    {
        $productCategory = new ProductCategory();

        $this->assertIsArray($productCategory->getFillable());
    }

    public function test_invoice_has_fillable()
    {
        $invoice = new Invoice();

        $this->assertIsArray($invoice->getFillable());
    }

    public function test_supplier_has_fillable()
    {
        $supplier = new Supplier();

        $this->assertIsArray($supplier->getFillable());
    }

    public function test_shopping_card_position_has_fillable()
    {
        $shoppingCartPosition = new ShoppingCartPosition();

        $this->assertIsArray($shoppingCartPosition->getFillable());
    }

    public function test_invoice_position_has_fillable()
    {
        $invoicePosition = new InvoicePosition();

        $this->assertIsArray($invoicePosition->getFillable());
    }

    public function test_user_has_fillable()
    {
        $user = new User();

        $this->assertIsArray($user->getFillable());
    }
}
