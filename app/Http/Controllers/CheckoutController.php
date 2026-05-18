<?php

namespace App\Http\Controllers;

use App\Services\ResourceServices\CheckoutService;

class CheckoutController extends Controller
{
	public function checkout()
	{
		try {
			$invoice = CheckoutService::checkout();
			redirect()->route('orders.show', ['token' => $invoice->token]);
		} catch(\Throwable $e) {
			return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
		}
	}
}
