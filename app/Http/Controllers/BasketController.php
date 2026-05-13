<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\ShoppingCartPosition;

class BasketController extends Controller
{
    public function show() {

        $products = Product::all();
        return view('basket');
    }

    public function put(Request $request) {
        if ($request->filled('productHandle')) {
            $product = Product::where('handle', '=', $request->input('productHandle'), false)->firstOrFail();
            $productAttributes = $product->attributes["properties"];
            $productAttributeNames = array_keys($productAttributes);
            $productAttributeCount = count($productAttributes);
            $selectedOptions["properties"] = [];
            for($i = 0; $i < $productAttributeCount; $i++) {
                $currentAttributeName = $productAttributeNames[$i];
                if($request->filled($currentAttributeName)) {
                    $selectedOptions["properties"][$currentAttributeName] = $request->input($currentAttributeName);
                }
            }
            $amount = $request->filled('amount') ? $request->input('amount'):'1';

            try {
                $basketQuery = ShoppingCartPosition::create(['session_id' => session()->getId(), 'product_id' => $product->id, 'amount' => $amount, 'selected_options' => $selectedOptions]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'success'
                ], 201);
            } catch(\Exception $e) {
                return response()->json([
                    'status' => 'failure',
                    'message' => $e->getMessage()
                ], 500);
            }
        }
        return response()->json([
            'status' => 'failure',
            'message' => 'Product missing!'
        ], 500);
    }

    public function remove(Response $response) {

    }
}
