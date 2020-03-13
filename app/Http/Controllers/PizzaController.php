<?php

namespace App\Http\Controllers;

use App\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function getList(Request $request)
    {
        return $this->success(Pizza::all());
    }
}
