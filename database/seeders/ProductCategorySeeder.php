<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        // T-Shirts (bestehend)
        ProductCategory::create([
            'category_id' => 1,
            'name' => 'T-Shirts',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color',
                    'options' => [
                        0 => [
                            'name' => 'Rot',
                            'value' => 'ff0000',
                        ],
                        1 => [
                            'name' => 'Blau',
                            'value' => '0000ff',
                        ],
                        2 => [
                            'name' => 'Grün',
                            'value' => '00ff00',
                        ],
                        3 => [
                            'name' => 'Weiß',
                            'value' => 'ffffff',
                        ],
                        4 => [
                            'name' => 'Schwarz',
                            'value' => '000000',
                        ]
                    ]
                ],
                'size' => [
                    'displayName' => 'Größe',
                    'type' => 'select',
                    'options' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select',
                    'options' => ['Baumwolle', 'Polyester', 'Viskose', 'Leinen']
                ]
            ]
        ]);

        // Hosen
        ProductCategory::create([
            'category_id' => 2,
            'name' => 'Hosen',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color',
                    'options' => [
                        0 => [
                            'name' => 'Schwarz',
                            'value' => '000000',
                        ],
                        1 => [
                            'name' => 'Blau',
                            'value' => '0000ff',
                        ],
                        2 => [
                            'name' => 'Gelb',
                            'value' => 'ffff00',
                        ],
                        3 => [
                            'name' => 'Weiß',
                            'value' => 'ffffff',
                        ],
                        4 => [
                            'name' => 'Pink',
                            'value' => 'ff00ff',
                        ]
                    ]
                ],
                'waist_size' => [
                    'displayName' => 'Bundweite',
                    'type' => 'range',
                    'options' => ['28', '29', '30', '31', '32', '33', '34', '36', '38', '40']
                ],
                'length' => [
                    'displayName' => 'Länge',
                    'type' => 'select',
                    'options' => ['Kurz', 'Normal', 'Lang', '30', '32', '34', '36']
                ],
                'fit' => [
                    'displayName' => 'Passform',
                    'type' => 'select',
                    'options' => ['Slim Fit', 'Regular Fit', 'Comfort Fit', 'Skinny', 'Straight']
                ]
            ]
        ]);

        // Schuhe
        ProductCategory::create([
            'category_id' => 3,
            'name' => 'Schuhe',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color',
                    'options' => [
                        0 => [
                            'name' => 'Dunkelrot',
                            'value' => '990000',
                        ],
                        1 => [
                            'name' => 'Christian-Louboutin-Rot',
                            'value' => 'ee1f25',
                        ],
                        2 => [
                            'name' => 'Rot',
                            'value' => 'aa0000',
                        ],
                        3 => [
                            'name' => 'Absolutes Rot',
                            'value' => 'ff0000',
                        ],
                        4 => [
                            'name' => 'Karminrot',
                            'value' => 'a13c3c',
                        ]
                    ]
                ],
                'shoe_size' => [
                    'displayName' => 'Schuhgröße',
                    'type' => 'range',
                    'options' => ['36', '46']
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select',
                    'options' => ['Leder', 'Textil', 'Synthetik', 'Wildleder']
                ]
            ]
        ]);

        // Jacken
        ProductCategory::create([
            'category_id' => 4,
            'name' => 'Jacken',
            'filters' => [
                'color' => [
                    'displayName' => 'Farbe',
                    'type' => 'color',
                    'options' => ['Schwarz', 'Navy', 'Grau', 'Grün', 'Beige', 'Braun']
                ],
                'size' => [
                    'displayName' => 'Größe',
                    'type' => 'select',
                    'options' => ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL']
                ],
                'warmth_level' => [
                    'displayName' => 'Wärmegrad',
                    'type' => 'select',
                    'options' => ['Leicht', 'Mittel', 'Warm', 'Sehr warm']
                ],
                'waterproof' => [
                    'displayName' => 'Wasserdicht',
                    'type' => 'boolean',
                    'options' => ['Ja', 'Nein']
                ]
            ]
        ]);

        // Taschen (haben keine Größen im klassischen Sinne)
        ProductCategory::create([
            'category_id' => 5,
            'name' => 'Taschen',
            'filters' => [
                'type' => [
                    'displayName' => 'Taschentyp',
                    'type' => 'select',
                    'options' => ['Handtasche', 'Umhängetasche', 'Rucksack', 'Clutch', 'Shopper', 'Tote']
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select',
                    'options' => ['Leder', 'Kunstleder', 'Baumwolle', 'Nylon', 'Stroh']
                ]
            ]
        ]);
    }
}