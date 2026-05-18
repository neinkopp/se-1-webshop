<?php

namespace App\Services\Providers;

use App\DTO\PaymentOrderData;

interface PrintProviderStrategy
{
	public function processOrder(PaymentOrderData $orderData): string;
}
