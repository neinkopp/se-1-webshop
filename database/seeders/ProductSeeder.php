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
                                'displayName' => 'Grün',
                                'value' => '#00ff00',
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
                        'material' => ['Baumwolle', 'Polyester'],
                        'print' => ['Prof. Mertens']
                    ]
                ]
            ]);
        }
        for($i = 10; $i < 15; $i++) {
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
                                'displayName' => 'Rot',
                                'value' => '#ff0000',
                                'pictures' => [
                                    [
                                        'picture_storage_key' => "mockup_product_".fake()->numberBetween(1,5).".png"
                                    ]
                                ],
                                'externalId' => 'asduashkd'
                            ],
                            [
                                'displayName' => 'Weiß',
                                'value' => '#ffffff',
                                'pictures' => [
                                    [
                                        'picture_storage_key' => "mockup_product_".fake()->numberBetween(1,5).".png"
                                    ]
                                ],
                                'externalId' => 'asduashkd'
                            ]
                        ],
                        'size' => ['XL', 'L', 'M'],
                        'material' => ['Leinen', 'Viskose'],
                        'print' => ['Prof. Mertens']
                    ]
                ]
            ]);
        }

        Product::create([
            'id' => fake()->uuid(),
            'category_id' => '1',
            'supplier_name' => "mock_supplier_1",
            'name' => fake()->name(),
            'handle' => "mock_product_15",
            'description' => fake()->text(),
            'price' => fake()->numberBetween(1,23),
            'attributes' => [
                'default_pictures' => [
                    [
                        'picture_storage_key' => "mockup_product_2.png"
                    ],
                    [
                        'picture_storage_key' => "mockup_product_2_1.png"
                    ],
                    [
                        'picture_storage_key' => "mockup_product_2_2.png"
                    ],
                    [
                        'picture_storage_key' => "mockup_product_2_3.png"
                    ]
                ],
                'properties' => [
                    'color' => [
                        [
                            'displayName' => 'Rot',
                            'value' => '#ff0000',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "mockup_product_2_red.png"
                                ]
                            ],
                            'externalId' => 'asduashkd'
                        ],
                        [
                            'displayName' => 'Grün',
                            'value' => '#00ff00',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "mockup_product_2_green.png"
                                ]
                            ],
                            'externalId' => 'asduawhkd'
                        ],
                        [
                            'displayName' => 'Blau',
                            'value' => '#0000ff',
                            'pictures' => [
                                [
                                    'picture_storage_key' => "mockup_product_2_blue.png"
                                ]
                            ],
                            'externalId' => 'asduahhkd'
                        ]
                    ],
                    'size' => ['XL', 'L', 'M'],
                    'material' => ['Baumwolle', 'Leinen', 'Viskose'],
                    'print' => ['Prof. Mertens']
                ]
            ]
        ]);
    }
}
