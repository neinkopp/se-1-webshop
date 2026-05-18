<?php

namespace App\Http\Controllers;

use App\Services\ResourceServices\OrderService;

class OrderController extends Controller
{
	public function show(string $token)
	{
		$orderInformation = OrderService::getOrderInformation($token);
		$invoice = $orderInformation['invoice'];
		$cartItemsBySupplier = $orderInformation['items'];
		$totalPrice = $orderInformation['totalPrice'];

		return view('order', [
			'invoice' => $invoice,
			'cartItemsBySupplier' => $cartItemsBySupplier,
			'totalPrice' => $totalPrice,
		]);
	}

	public function showForm() {
		return view('order-form');
	}
}
