<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable
        = [
            'orderList',
            'totalPrice',
            'name',
            'phone',
            'address'
        ];
    protected $hidden = ['updatedAt', 'id'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function setOrderListAttribute($orderList)
    {
        $orderList = collect($orderList)->map(function ($id) {
            $pizza = Pizza::find($id);
            return [
                'name' => $pizza->name,
                'price' => $pizza->price_usd,
            ];
        });
        $this->attributes['order_list'] = $orderList->toJson();
    }

    public function setTotalPriceAttribute($totalPrice)
    {
        $this->attributes['total'] = (double)$totalPrice;
    }
}
