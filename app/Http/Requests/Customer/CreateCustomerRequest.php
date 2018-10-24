<?php

namespace App\Http\Requests\Customer;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Customer::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'observations' => 'nullable|string'
        ];
    }
}
