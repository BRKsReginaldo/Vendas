<?php

namespace App\Http\Requests\ProductBuy;

use App\ProductBuy;
use Illuminate\Foundation\Http\FormRequest;

class ShowProductBuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('show', $this->getModel('product_buy', ProductBuy::class));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
