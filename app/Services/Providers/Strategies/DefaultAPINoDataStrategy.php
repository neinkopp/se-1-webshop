<?php

namespace App\Services\Providers\Strategies;

use App\DTO\PaymentOrderData;
use App\Services\Providers\PrintProviderStrategy;
use Illuminate\Support\Facades\Http;

class DefaultAPINoDataStrategy implements PrintProviderStrategy
{
	public function processOrder(PaymentOrderData $orderData): string
	{
		$redirect_url = Http::post("http://localhost:3001/api/init-checkout", [
			"order_token" => $orderData->orderToken,
			"products" => $orderData->positions,
			"customer" => [
				"name" => "Jakobus"
			]
		])["payment_url"];

		return $redirect_url;
	}
}
