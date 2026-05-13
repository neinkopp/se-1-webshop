<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCartPosition;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    public function show()
    {
        $cartItems = ShoppingCartPosition::with('product.supplier')
            ->where('session_id', session()->getId())
            ->get();

        $cartItemsBySupplier = $cartItems->groupBy('product.supplier.name');

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->amount;
        });

        $totalItems = $cartItems->sum('amount');

        return view('basket', compact('cartItemsBySupplier', 'totalPrice', 'totalItems'));
    }

    public function put(Request $request)
    {
        $rules = [
            'productHandle' => 'required|string|max:255',
            'amount' => 'required|integer|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::where('handle', '=', $request->input('productHandle'), false)->firstOrFail();
        $productAttributes = $product->attributes["properties"];
        $productAttributeNames = array_keys($productAttributes);
        $productAttributeCount = count($productAttributes);
        $selectedOptions["properties"] = [];
        for ($i = 0; $i < $productAttributeCount; $i++) {
            $currentAttributeName = $productAttributeNames[$i];
            if ($request->filled($currentAttributeName)) {
                $selectedOptions["properties"][$currentAttributeName] = $request->input($currentAttributeName);
            }
        }
        $amount = $request->input('amount');

        try {
            $basketQuery = ShoppingCartPosition::create(['session_id' => session()->getId(), 'product_id' => $product->id, 'amount' => $amount, 'selected_options' => $selectedOptions]);

            return response()->json([
                'status' => 'success',
                'message' => 'success'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function change(Request $request)
    {
        $rules = [
            'position_id' => 'required|integer|min:1',
            'amount' => 'required|integer'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $shoppingCartPosition = ShoppingCartPosition::where('position_id', '=', $request->input('position_id'), false)->firstOrFail();
            if ($shoppingCartPosition->amount + $request->input('amount') < 1) {
                ShoppingCartPosition::where('position_id', '=', $request->input('position_id'), false)->delete();
            } else {
                $shoppingCartPosition->amount += $request->input('amount');
                $shoppingCartPosition->save();
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'success'
        ], 201);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'position_id' => 'required|integer|exists:shopping_cart_positions,id',
        ]);

        ShoppingCartPosition::destroy($request->input('position_id'));

        return redirect()->route('basket.show');
    }
}
