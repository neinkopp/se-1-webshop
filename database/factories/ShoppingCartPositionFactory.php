<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ShoppingCartPosition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * @extends Factory<ShoppingCartPosition>
 */
class ShoppingCartPositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sessionId = 'Daf1c52fbKxSxqxzCkRW2z3LaV1BgXUNj5GvmpRF';
        session()->setId($sessionId);

        // 1. SATISFY THE CONSTRAINT: Insert the session ID directly into the database
        DB::table('session')->insertOrIgnore([
            'id' => $sessionId,
            'payload' => '',
            'last_activity' => time(),
        ]);
        return [
            'position_id' => $this->faker->unique()->randomNumber(2),
            'session_id' => $sessionId,
            'product_id' => Product::factory(),
            'amount' => 1,
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
