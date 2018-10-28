<?php

namespace App\Http\Requests\ProductBuy;

use App\ProductBuy;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductBuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', ProductBuy::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'observations' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer'
        ];
    }
}
