<?php

namespace App\Services\Providers\Strategies;

use App\DTO\PaymentOrderData;
use App\Services\Providers\PrintProviderStrategy;
use Illuminate\Support\Facades\Http;

class DefaultAPIDataStrategy implements PrintProviderStrategy
{
	public function processOrder(PaymentOrderData $orderData): string
	{
		$redirect_url = Http::post(config("services.webshops.webshop_1_url") . "/api/init-checkout", [
			"order_token" => $orderData->order_token,
			"products" => $orderData->positions,
			"customer" => [
				'name' => $orderData->customer_data->customer_name,
				'street' => $orderData->customer_data->customer_street,
				'zip' => $orderData->customer_data->customer_zip,
				'city' => $orderData->customer_data->customer_city,
				'country' => $orderData->customer_data->customer_country,
				'email' => $orderData->customer_data->customer_email,
				'phone' => $orderData->customer_data->customer_phone,
				'delivery_name' => $orderData->customer_data->delivery_city,
				'delivery_street' => $orderData->customer_data->delivery_street,
				'delivery_zip' => $orderData->customer_data->delivery_zip,
				'delivery_city' => $orderData->customer_data->delivery_city,
				'delivery_country' => $orderData->customer_data->delivery_country,
			]
		])["payment_url"];

		return $redirect_url;
	}
}
