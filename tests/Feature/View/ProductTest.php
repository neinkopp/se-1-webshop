<?php

namespace Tests\Feature\View;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $this->withoutVite();

        $dummyProduct = [
            'productImagePath' => 'resources/images/test-product.png',
            'productDisplayName' => 'Test Produkt',
            'productDescription' => "Dies ist eine description",
            'productDisplayPrice' => '19.99'
        ];

        $contents = $this->view('product', [
            'product' => $dummyProduct // Hier die Variable übergeben!
        ]);

        $contents->assertSee('');
    }
}
