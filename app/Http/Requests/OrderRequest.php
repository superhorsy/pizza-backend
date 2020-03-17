<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use App\Pizza;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'orderList'      => 'required|array',
            'totalPrice'     => 'required',
            'name'           => 'required|string',
            'phone'          => 'required|string',
            'address'        => 'required|string',
        ];
    }

    public function validateOrderRequest()
    {
        $ids = collect($this->orderList)->pluck('id');

        /** @var Collection $order */
        $pizzaList = Pizza::whereIn('id', $ids)->get(
            [
                'id',
                'name',
                'price_usd'
            ]
        );

        $total = 0;

        foreach ($this->orderList as $position) {
            $total += $pizzaList->firstWhere(
                'id',
                '=',
                $position['id']
            )->price_usd;
        }

        if ($total != $this->totalPrice) {
            throw new ApiException(
                "Something wrong with your order, please try again",
                ApiException::VALIDATION_ERROR
            );
        }
    }
}
