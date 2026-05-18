<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeBasketItemRequest;
use App\Http\Requests\DeleteBasketItemRequest;
use App\Http\Requests\PutInBasketRequest;
use App\Services\ResourceServices\BasketService;

class BasketController extends Controller
{
    public function show()
    {
        $basketInformation = BasketService::getBasketInformation();

        $cartItemsBySupplier = $basketInformation['items'];
        $totalPrice = $basketInformation['totalPrice'];
        $totalItems = $basketInformation['totalItems'];

        return view('basket', compact('cartItemsBySupplier', 'totalPrice', 'totalItems'));
    }

    public function put(PutInBasketRequest $request)
    {
        $requestedData = $request->validated();
        try {

            $newCartItem = BasketService::addItemToCart($requestedData['productHandle'], $requestedData['amount'], $request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'success'
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function change(ChangeBasketItemRequest $request)
    {
        $requestedData = $request->validated();
        try {

            BasketService::updateItemQuantity($requestedData['position_id'], $requestedData['amount']);

            return response()->json([
                'status' => 'success',
                'message' => 'success'
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function remove(DeleteBasketItemRequest $request)
    {
        $requestedData = $request->validated();
        try {

            BasketService::removeItemFromCart($requestedData['position_id']);

            return redirect()->route('basket.show');
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
