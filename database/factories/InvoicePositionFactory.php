<?php

namespace Database\Factories;

use App\Models\InvoicePosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoicePosition>
 */
class InvoicePositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_position_id' => 1,
            'invoice_id' => 17,
            'product_id' => 'b0e923bc-5d73-314f-a8c4-499eebcc48ff',
            'amount' => 1,
            'price' => 30,
            'selected_options' => [
                "properties" => [
                    "size" => "XL",
                    "color" => "türkisch",
                    "material" => "Baumwolle"
                ]
            ]
        ];
    }
}
