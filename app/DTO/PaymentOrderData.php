<?php

namespace App\DTO;

class PaymentOrderData
{
	/**
	 * @param PaymentPositionData[] $positions
	 */
	public function __construct(
		public readonly string $order_token,

		public readonly PaymentOrderCustomerData|null $customer_data,

		public readonly array $positions,
	) {}
}
