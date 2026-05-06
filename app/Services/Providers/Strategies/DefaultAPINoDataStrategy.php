<?php

namespace App\Services\Providers\Strategies;

use App\Services\Providers\PrintProviderStrategy;

class DefaultAPINoDataStrategy implements PrintProviderStrategy
{
	public function processOrder(array $orderData): string
	{
		return "";
	}
}
