<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'category_id' => 1,
            'name' => 'T-Shirts',
            'filters' => [
                'filters' => [
                    'color' => [
                        'displayName' => 'Farbe',
                        'type' => 'color',
                    ],
                    'size' => [
                        'displayName' => 'Größe',
                        'type' => 'select',
                    ],
                    'shape' => [
                        'displayName' => 'Form',
                        'type' => 'select',
                    ],
                ]
            ]
        ]);
    }
}
