<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const CART_SESSION_KEY = 'cart';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
