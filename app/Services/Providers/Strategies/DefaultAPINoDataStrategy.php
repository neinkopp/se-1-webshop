<?php

namespace App\Services\Providers\Strategies;

use App\DTO\PaymentOrderData;
use App\Services\Providers\PrintProviderStrategy;
use Illuminate\Support\Facades\Http;

class DefaultAPINoDataStrategy implements PrintProviderStrategy
{
	public function processOrder(PaymentOrderData $orderData): string
	{
		return config("services.webshops.webshop_2_url") . "/api/init-checkout";
	}
}
