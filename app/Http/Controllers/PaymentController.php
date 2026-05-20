<?php

namespace App\Http\Controllers;

use App\DTO\PaymentOrderCustomerData;
use App\DTO\PaymentOrderData;
use App\DTO\PaymentPositionData;
use App\Models\Invoice;
use App\Services\Providers\ProviderFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
	public function initatePayment(Request $request): RedirectResponse
	{
		$validated = $request->validate([
			'invoice_id' => ['required'],
			'supplier_name' => ['required'],

			'customer_name' => ['required'],
			'customer_street' => ['required'],
			'customer_zip' => ['required'],
			'customer_city' => ['required'],
			'customer_country' => ['required'],
			'customer_email' => ['required'],
			'customer_phone' => ['required'],
			'delivery_name' => ['nullable'],
			'delivery_street' => ['nullable'],
			'delivery_zip' => ['nullable'],
			'delivery_city' => ['nullable'],
			'delivery_country' => ['nullable'],
		]);

		$invoice_id = $validated["invoice_id"];
		$supplier_name = $validated["supplier_name"];

		// get order details
		$invoice = Invoice::where("invoice_id", $invoice_id)->with("positions.product")->first();
		$positions = $invoice->positions
			->filter(fn($p) => $p->product->supplier_name === $supplier_name);

		$payment_positions = $positions
			->map(
				fn($position) =>
				PaymentPositionData::fromInvoicePosition($position)
			)
			->all();

		$payment_customer_data = new PaymentOrderCustomerData(
			$validated['customer_name'],
			$validated['customer_street'],
			$validated['customer_zip'],
			$validated['customer_city'],
			$validated['customer_country'],
			$validated['customer_email'],
			$validated['customer_phone'],
			$validated['delivery_name'] ?? null,
			$validated['delivery_street'] ?? null,
			$validated['delivery_zip'] ?? null,
			$validated['delivery_city'] ?? null,
			$validated['delivery_country'] ?? null,
		);

		$payment_order_data = new PaymentOrderData($invoice->token, $payment_customer_data, $payment_positions);

		$strategy = ProviderFactory::make($supplier_name);
		$redirect_url = $strategy->processOrder($payment_order_data);

		return \redirect()->away($redirect_url);
	}
}
