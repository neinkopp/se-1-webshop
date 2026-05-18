<?php

namespace App\Services\ResourceServices;
use App\Models\Invoice;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct(){}

    public static function getOrderInformation(string $token) {
        $invoice = Invoice::where('token', $token)->with('positions.product.supplier')->firstOrFail();

		$cartItemsBySupplier = $invoice->positions->groupBy('product.supplier.display_name');

		$totalPrice = OrderService::getTotalPrice($invoice);

        return ['invoice' => $invoice, 'items' => $cartItemsBySupplier, 'totalPrice' => $totalPrice];
    }

    private static function getTotalPrice(Invoice $invoice):int {
        return $invoice->positions->sum(function ($position) {
			return $position->amount * $position->price_per_unit;
		});
    }
}
