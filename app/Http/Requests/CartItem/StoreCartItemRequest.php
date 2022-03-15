<?php

namespace App\Http\Requests\CartItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartItemRequest extends FormRequest
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
            'product_id' => [
                'required',
                'integer',
                'exists:products,id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'price' => [
                'required',
                'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/',
                'min:0'
            ],
        ];
    }

    /**
     * Mutate the request data before passing to validation
     *
     * @return void
     */
    protected function prepareForValidation(): void {

        $this->merge([
            'product_id'      => decode_hashid($this->product),
            'quantity'        => $this->quantity ?? 1,
            'user_id'         => auth()->user()->id,
            'price'           => floatval($this->productPrice)
        ]);
    }
}
