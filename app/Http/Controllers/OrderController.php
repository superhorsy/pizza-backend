<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Order;
use App\Pizza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var Order
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Places new order
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ApiException
     */
    public function placeOrder(Request $request)
    {
        $this->validateOrderRequest($request);

        $this->order = $this->order->create($request->all());

        if ($user = Auth::user()) {
            $this->order->user()->associate($user);
        }

        return $this->success($this->order);
    }

    private function checkTotalPrice($orderList, $totalPrice)
    {
        $total = 0;

        foreach ($orderList as $dishId) {
            $total += Pizza::find($dishId)->price_usd;
        }

        if ($total != $totalPrice) {
            throw new ApiException(
                "Something wrong with your order, please try again",
                ApiException::VALIDATION_ERROR
            );
        }
    }

    /**
     * @param $request
     * @throws ApiException
     */
    protected function validateOrderRequest($request): void
    {
        $request->validate([
            'orderList' => 'required|array',
            'totalPrice' => 'required',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
        $this->checkTotalPrice($request->orderList, $request->totalPrice);
    }
}
