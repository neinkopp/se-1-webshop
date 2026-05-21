<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => 8,
            'name' => 'Hoodies',
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
        ];
    }
}
