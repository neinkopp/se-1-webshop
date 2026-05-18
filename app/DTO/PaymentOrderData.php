<?php

namespace App\DTO;

class PaymentOrderData
{
	/**
	 * @param PaymentPositionData[] $positions
	 */
	public function __construct(
		public readonly string $orderToken,
		public readonly array $positions,
	) {}
}
