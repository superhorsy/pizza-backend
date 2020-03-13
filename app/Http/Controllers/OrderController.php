<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use Illuminate\Support\Facades\Auth;

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
     * @param  OrderRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ApiException
     */
    public function placeOrder(OrderRequest $request)
    {
        $request->validateOrderRequest();

        $this->order = $this->order->create($request->all());

        if ($user = Auth::user()) {
            $this->order->user()->associate($user);
        }

        return $this->success($this->order);
    }
}
