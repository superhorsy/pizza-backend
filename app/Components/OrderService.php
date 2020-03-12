<?php


namespace App\Components;


use App\Order;
use Illuminate\Support\Facades\Session;

class OrderService
{
    public static function getCurrentOrder()
    {
        $currentOrder = Session::get(Order::CART_SESSION_KEY);
        return ['currentOrder' => $currentOrder];
    }

    public static function updateCart($id)
    {
        $cart = static::getCart();
        $cart->add($id);
        Session::push(Order::CART_SESSION_KEY, $cart);
    }

    public static function getCart()
    {
        return collect(Session::get(Order::CART_SESSION_KEY,[]));
    }

}
