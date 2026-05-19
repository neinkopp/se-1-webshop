<?php

namespace App\Services\ResourceServices;

use App\Models\Product;
use App\Models\ShoppingCartPosition;
use Illuminate\Database\Eloquent\Collection;

class BasketService
{
    public static function addItemToCart(string $productHandle, int $amount = 1, array $requestedProperties = []): ShoppingCartPosition
    {
        $product = Product::where('handle', '=', $productHandle)->firstOrFail();

        $selectedOptions = BasketService::toSelectedOptions($product->attributes["properties"], $requestedProperties);
        return ShoppingCartPosition::create(['session_id' => session()->getId(), 'product_id' => $product->id, 'amount' => $amount, 'selected_options' => $selectedOptions]);
    }

    private static function toSelectedOptions(array $productProperties, array $requestedProperties): array
    {
        $productPropertyNames = array_keys($productProperties);
        $productPropertyCount = count($productProperties);
        $selectedOptions["properties"] = [];
        for ($i = 0; $i < $productPropertyCount; $i++) {
            $currentAttributeName = $productPropertyNames[$i];
            if ($currentAttributeName !== 'print') {
                if (array_key_exists($currentAttributeName, $requestedProperties)) {
                    $selectedOptions["properties"][$currentAttributeName] = $requestedProperties[$currentAttributeName];
                }
            }
        }
        return $selectedOptions;
    }

    public static function updateItemQuantity(int $positionId, int $amount): ShoppingCartPosition
    {
        $shoppingCartPosition = ShoppingCartPosition::where('position_id', '=', $positionId)->firstOrFail();
        if ($shoppingCartPosition->amount + $amount < 1) {
            return ShoppingCartPosition::where('position_id', '=', $positionId)->delete();
        } else {
            $shoppingCartPosition->amount += $amount;
            return $shoppingCartPosition->save();
        }
    }

    public static function removeItemFromCart(int $positionId): int
    {
        return ShoppingCartPosition::destroy($positionId);
    }

    public static function getBasketInformation(): array
    {

        $cartItems = ShoppingCartPosition::with('product.supplier')->where('session_id', session()->getId())->get();

        return ['items' => BasketService::groupBySupplier($cartItems), 'totalPrice' => BasketService::getTotalPrice($cartItems), 'totalItems' => BasketService::getTotalItems($cartItems)];
    }

    private static function groupBySupplier(Collection $cartItems): Collection
    {
        return $cartItems->groupBy('product.supplier.display_name');
    }

    private static function getTotalPrice(Collection $cartItems): int
    {
        return $cartItems->sum(function ($item) {
            return $item->product->price * $item->amount;
        });
    }

    private static function getTotalItems(Collection $cartItems): int
    {
        return $cartItems->sum('amount');
    }
}
