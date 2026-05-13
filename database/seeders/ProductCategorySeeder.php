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
                    'type' => 'color'
                ],
                'size' => [
                    'displayName' => 'Größe',
                    'type' => 'select'
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
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
                    'type' => 'color'
                ],
                'waist_size' => [
                    'displayName' => 'Bundweite',
                    'type' => 'select'
                ],
                'length' => [
                    'displayName' => 'Länge',
                    'type' => 'select'
                ],
                'fit' => [
                    'displayName' => 'Passform',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
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
                ],
                'shoe_size' => [
                    'displayName' => 'Schuhgröße',
                    'type' => 'select'
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
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
                    'type' => 'color'
                ],
                'size' => [
                    'displayName' => 'Größe',
                    'type' => 'select'
                ],
                'warmth_level' => [
                    'displayName' => 'Wärmegrad',
                    'type' => 'select'
                ],
                'waterproof' => [
                    'displayName' => 'Wasserdicht',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
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
                    'type' => 'select'
                ],
                'material' => [
                    'displayName' => 'Material',
                    'type' => 'select'
                ],
                'print' => [
                    'displayName' => 'Aufdruck',
                    'type' => 'select'
                ]
            ]
        ]);
    }
}