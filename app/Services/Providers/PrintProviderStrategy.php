<?php

namespace App\Services\Providers;

interface PrintProviderStrategy
{
	public function processOrder(array $orderData): string;
}
