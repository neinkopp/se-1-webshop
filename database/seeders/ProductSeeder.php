<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++) {
            Product::create([
                'id' => fake()->uuid(),
                'category_id' => '1',
                'supplier_name' => "mock_supplier_1",
                'name' => fake()->name(),
                'handle' => "mock_product_{$i}",
                'description' => fake()->text(),
                'price' => fake()->numberBetween(1,23),
                'attributes' => [
                    'default_pictures' => [
                        [
                            'picture_storage_key' => "mockup_product_".fake()->numberBetween(1,5).".png"
                        ]
                    ],
                    'properties' => [
                        'color' => [
                            [
                                'displayName' => 'Olivgrün',
                                'value' => '#123456',
                                'pictures' => [
                                    [
                                        'picture_storage_key' => "mockup_product_".fake()->numberBetween(1,5).".png"
                                    ]
                                ],
                                'externalId' => 'asduashkd'
                            ],
                            [
                                'displayName' => 'Blau',
                                'value' => '#123456',
                                'pictures' => [
                                    [
                                        'picture_storage_key' => "mockup_product_".fake()->numberBetween(1,5).".png"
                                    ]
                                ],
                                'externalId' => 'asduashkd'
                            ]
                        ],
                        'size' => ['XS', 'XL', 'XXL'],
                        'shape' => [
                            ['displayName' => 'Dreieckig']
                        ]
                    ]
                ]
            ]);
        }
    }
}
