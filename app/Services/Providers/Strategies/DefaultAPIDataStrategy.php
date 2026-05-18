<?php

namespace App\Services\Providers\Strategies;

use Illuminate\Support\Facades\Http;
use App\Services\Providers\PrintProviderStrategy;
use App\DTO\PaymentOrderData;

class DefaultAPIDataStrategy implements PrintProviderStrategy
{
	public function processOrder(PaymentOrderData $orderData): string
	{
		return "";
	}
}
