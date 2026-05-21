<?php

namespace App\Services\ResourceServices;
use App\Models\Invoice;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct(){}

    public static function getOrderInformation(string $token) {
        $invoice = Invoice::where('token', $token)->with('positions.product.supplier')->firstOrFail();
        
		$cartItemsBySupplier = $invoice->positions->groupBy('product.supplier.display_name');

        foreach($cartItemsBySupplier as $cartItems) {
            foreach($cartItems as $cartItem) {
                $selectedOptions['properties'] = $cartItem->selected_options['properties'];
                $product = $cartItem->product;
                $attributes = $product->attributes;
                $image = $cartItem->product->attributes['default_pictures'][0]?$cartItem->product->attributes['default_pictures'][0]['picture_storage_key']:null;
                if(isset($selectedOptions['properties']['color']) && isset($cartItem->product->attributes['properties']['color'])) {
                    $selectedOptions['properties']['color'] = BasketService::appendColorValues($selectedOptions['properties']['color'], $cartItem->product->attributes['properties']['color']);
                    $image = $selectedOptions['properties']['color']['image'];
                }
                $selectedOptions['properties'] = BasketService::appendPropertyDisplayNames($selectedOptions['properties'], $cartItem->product->category_id);
                $cartItem->selected_options = $selectedOptions;
                $attributes['default_pictures'][0]['picture_storage_key'] = $image;
                $product->attributes = $attributes;
                $cartItem->product = $product;
            }
        }

		$totalPrice = OrderService::getTotalPrice($invoice);

        return ['invoice' => $invoice, 'items' => $cartItemsBySupplier, 'totalPrice' => $totalPrice];
    }

    private static function getTotalPrice(Invoice $invoice):float {
        return $invoice->positions->sum(function ($position) {
			return (float)$position->amount * $position->price_per_unit;
		});
    }
}
