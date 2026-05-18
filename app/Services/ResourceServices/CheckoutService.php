<?php

namespace App\Services\ResourceServices;

use App\Models\Invoice;
use App\Models\ShoppingCartPosition;
use App\Models\InvoicePosition;
use App\Models\Product;
use Illuminate\Support\Str;

class CheckoutService
{
    public function __construct(){}

    public static function checkout():Invoice {
        $session_id = session()->getId();
		$shoppingCartPositions = ShoppingCartPosition::where('session_id', $session_id)->get();

		if ($shoppingCartPositions->isEmpty()) {
			throw new \Exception('Dein Warenkorb ist leer.');
		}

		$invoice = Invoice::create([
			'token' => Str::random(32),
			'order_date' => now(),
		]);

		foreach ($shoppingCartPositions as $position) {
			$product = Product::find($position->product_id);
			InvoicePosition::create([
				'invoice_id' => $invoice->invoice_id,
				'product_id' => $position->product_id,
				'amount' => $position->amount,
				'price_per_unit' => $product->price,
				'selected_options' => $position->selected_options,
			]);
		}

		ShoppingCartPosition::where('session_id', $session_id)->delete();

		return $invoice;
    }
}
