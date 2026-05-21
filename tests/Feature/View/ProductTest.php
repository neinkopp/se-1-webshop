<?php

namespace Tests\Feature\View;

use App\Models\Product;
use App\Services\ResourceServices\ProductService;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_can_render(): void
    {
        $this->withoutVite();

        $product = Product::factory()->create([]);
        $product = ProductService::replaceAttributesTechnicalNamesWithDisplayNames($product);
        $product = ProductService::replaceTechnicalSupplierNameWithSupplierDisplayName($product);

        $contents = $this->view('product', [
            'product' => $product, // Hier die Variable übergeben!
            'featuredProducts' => [$product]
        ]);

        $contents->assertSee('');
    }
}
