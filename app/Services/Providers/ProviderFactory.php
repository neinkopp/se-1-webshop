<?php

namespace App\Services\Providers;

use App\Services\Providers\Strategies\DefaultAPINoDataStrategy;
use App\Services\Providers\Strategies\DefaultAPIDataStrategy;
use InvalidArgumentException;

class ProviderFactory
{
	public static function make(string $supplierName): PrintProviderStrategy
	{
		return match ($supplierName) {
			"mock_supplier_1" => new DefaultAPINoDataStrategy(),
			"default_api_data" => new DefaultAPIDataStrategy(),
			default => throw new InvalidArgumentException("Dienstleister $supplierName nicht gefunden")
		};
	}
}
