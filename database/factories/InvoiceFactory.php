<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => 17,
            'token' => 'ttsEWsOrlczCRATXc8CQQqgZoduvQGoh',
            'order_date' => '2026-05-20',
            'created_at' => '2026-05-20 18:03:42',
            'updated_at' => '2026-05-20 18:03:42'
        ];
    }
}
