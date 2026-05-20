<?php

namespace App\DTO;

class PaymentOrderCustomerData
{
	public function __construct(
		public readonly string $customer_name,
		public readonly string $customer_street,
		public readonly string $customer_zip,
		public readonly string $customer_city,
		public readonly string $customer_country,
		public readonly string $customer_email,
		public readonly string $customer_phone,

		public readonly string|null $delivery_name,
		public readonly string|null $delivery_street,
		public readonly string|null $delivery_zip,
		public readonly string|null $delivery_city,
		public readonly string|null $delivery_country,
	) {}
}
