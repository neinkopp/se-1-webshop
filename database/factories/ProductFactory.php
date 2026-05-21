<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => 'b0e923bc-5d73-314f-a8c4-499eebcc48ff',
            'category_id' => ProductCategory::factory(),
            'supplier_name' => Supplier::factory(),
            'name' => "AStA-Hoodie",
            'handle' => "test_hoodie",
            'description' => "Angenehm warmer kuscheliger Baumwollhoodie mit Aufdruck des AStAs. Wie cool! Für alle, die im Winter die Vorlesungen überstehen möchten!",
            'price' => 39.99,
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "asta-Hoodie-Blau-Vorne.png"
                    ],
                    [
                        'picture_storage_key' => "asta-Hoodie-Blau-Hinten.png"
                    ],
                    [
                        'picture_storage_key' => "asta-Hoodie-Rot-Vorne.png"
                    ],
                    [
                        'picture_storage_key' => "asta-Hoodie-Rot-Hinten.png"
                    ]
                ],
                'assets' => [
                    [
                        "asset_storage_key" => "asta-logo.png",
                        "position" => "front"
                    ],
                    [
                        "asset_storage_key" => "BHH-Logo.png",
                        "position" => "back"
                    ]
                ],
                'properties' => [
                'color' => [
                    [
                        'displayName' => 'blau',
                        'value' => '#2c0866',
                        'pictures' => [
                            [
                                'picture_storage_key' => "asta-Hoodie-Blau-Vorne.png"
                            ],
                            [
                                'picture_storage_key' => "asta-Hoodie-Blau-Hinten.png"
                            ]
                        ],
                        'externalId' => 'asduashkwda'
                    ],
                    [
                        'displayName' => 'rot',
                        'value' => '#c20d0d',
                        'pictures' => [
                            [
                                'picture_storage_key' => "asta-Hoodie-Rot-Vorne.png"
                            ],
                            [
                                'picture_storage_key' => "asta-Hoodie-Rot-Hinten.png"
                            ]
                        ],
                        'externalId' => 'asduawhkdaa'
                    ],
                    
                ],
                    'size' => ['XL', 'L', 'M','S'],
                    'material' => ['Baumwolle'],
                    'print' => ['AStA']
                ]
            ]
        ];
    }
}
