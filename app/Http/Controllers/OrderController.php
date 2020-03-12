<?php

namespace App\Http\Controllers;

use App\Components\OrderService;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate(
            [
                'id' => 'integer|exists:pizzas'
            ]
        );
        OrderService::updateCart($request->id);
        return $this->success(OrderService::getCart());
    }
}
