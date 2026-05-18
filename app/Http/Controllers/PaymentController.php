<?php

namespace App\Http\Controllers;

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

		$payment_order_data = new PaymentOrderData($invoice->token, $payment_positions);

		$strategy = ProviderFactory::make($supplier_name);
		$redirect_url = $strategy->processOrder($payment_order_data);

		return \redirect()->away($redirect_url);
	}
}
