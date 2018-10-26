<?php

namespace App\Http\Requests\ProductBuy;

use App\ProductBuy;
use Illuminate\Foundation\Http\FormRequest;

class RestoreProductBuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $productBuy = ProductBuy::withTrashed()->findOrFail($this->route('id'));
        return $this->user()->can('restore', $productBuy);
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
