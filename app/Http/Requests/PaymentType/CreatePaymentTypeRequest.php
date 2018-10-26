<?php

namespace App\Http\Requests\PaymentType;

use App\PaymentType;
use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', PaymentType::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string',
            'observations' => 'nullable|string'
        ];
    }
}
