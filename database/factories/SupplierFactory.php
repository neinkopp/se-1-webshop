<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_name' => 'mock',
            'website' => 'Le.Sserafim.de',
            'email' => 'lesserafim@gmail.de',
            'telephone' => '+49 123 456789 1',
            'display_name' => 'Le Sserafim'
        ];
    }
}
