<?php

namespace App\Services\ResourceServices;

use App\Models\Product;
use App\Models\ProductCategory;
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

        return ['items' => BasketService::groupBySupplier($cartItems), 'totalPrice' => BasketService::getTotalPrice($cartItems), 'totalItems' => BasketService::getTotalItems($cartItems)];
    }

    public static function appendColorValues(string $colorName, array $colors):array {
        foreach($colors as $colorId => $color) {
            if ($color['displayName'] == $colorName) {
                return ['name' => $colorName, 'value' => $color['value'], 'image' => $color['pictures'][0]?$color['pictures'][0]['picture_storage_key']:''];
            }
        }
        return ['name' => $colorName];
    }

    private static function groupBySupplier(Collection $cartItems): Collection
    {
        return $cartItems->groupBy('product.supplier.display_name');
    }

    private static function getTotalPrice(Collection $cartItems): float
    {
        return $cartItems->sum(function ($item) {
            return $item->product->price * (float)$item->amount;
        });
    }

    private static function getTotalItems(Collection $cartItems): int
    {
        return $cartItems->sum('amount');
    }

    public static function appendPropertyDisplayNames(array $properties, int $categoryId):array {
        $category = ProductCategory::where('category_id', '=', $categoryId)->firstOrFail();

        foreach ($properties as $propertyName => $property) {
            $propertyDisplayName = $category->filters[$propertyName]['displayName'] ?? $propertyName;
            $properties[$propertyDisplayName] = $property;
            unset($properties[$propertyName]);
        }

        return $properties;
    }
}
