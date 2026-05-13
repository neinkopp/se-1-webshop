<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\ShoppingBasketPosition;

class BasketController extends Controller
{
    public function show() {

        $products = Product::all();
        return view('basket');
    }

    public function put(Request $request) {
        if ($request->filled('productHandle')) {
            $product = Product::where('handle', '=', $request->query('productHandle'), false)->firstOrFail();
            $productAttributes = $product->attributes["properties"];
            $productAttributeNames = array_keys($productAttributes);
            $productAttributeCount = count($productAttributes);
            $selectedOptions["properties"] = [];
            for($i = 0; $i < $productAttributeCount; $i++) {
                $currentAttributeName = $productAttributeNames[$i];
                $currentAttribute = $productAttributes[$currentAttributeName];
                if($request->filled($currentAttributeName)) {
                    $selectedOptions["properties"][$currentAttributeName] = $currentAttribute;
                }
            }
            $amount = $request->filled('amount') ? $request->query('amount'):'1';

            try {
                $basketQuery = ShoppingBasketPosition::create(['1',session()->getId(), $product->id(), $amount, $selectedOptions]);

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
            'message' => 'Product missing'
        ], 500);
    }

    public function remove(Response $response) {

    }
}
