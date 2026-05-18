<?php

namespace App\DTO;

use App\Models\InvoicePosition;

class PaymentPositionData
{
	public function __construct(
		public readonly string $name,
		public readonly int $amount,
		public readonly int $unitPrice,
		public readonly array $selected_options,
	) {}

	public static function fromInvoicePosition(InvoicePosition $invoicePosition): self
	{
		return new self(
			$invoicePosition->product->name,
			$invoicePosition->amount,
			$invoicePosition->price_per_unit,
			$invoicePosition->selected_options["properties"]
		);
	}
}
