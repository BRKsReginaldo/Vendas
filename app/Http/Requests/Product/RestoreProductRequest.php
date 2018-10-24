<?php

namespace App\Http\Requests\Product;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class RestoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $product = Product::withTrashed()->find($this->route('id'));
        return $this->user()->can('restore', $product);
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
