<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoicePosition;
use App\Models\Product;
use App\Models\ShoppingCartPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
	public function checkout(Request $request)
	{
		$session_id = Session::getId();
		$shoppingCartPositions = ShoppingCartPosition::where('session_id', $session_id)->get();

		if ($shoppingCartPositions->isEmpty()) {
			return redirect()->route('basket.show')->with('error', 'Your shopping cart is empty.');
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

		return redirect()->route('orders.show', ['token' => $invoice->token]);
	}
}
