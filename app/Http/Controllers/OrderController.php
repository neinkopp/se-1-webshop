<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function show(Request $request, $token)
	{
		$invoice = Invoice::where('token', $token)->with('positions.product.supplier')->firstOrFail();

		$cartItemsBySupplier = $invoice->positions->groupBy('product.supplier.display_name');

		$totalPrice = $invoice->positions->sum(function ($position) {
			return $position->amount * $position->price_per_unit;
		});

		return view('order', [
			'invoice' => $invoice,
			'cartItemsBySupplier' => $cartItemsBySupplier,
			'totalPrice' => $totalPrice,
		]);
	}
}
