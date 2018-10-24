<?php

namespace App\Http\Requests\Provider;

use App\Provider;
use Illuminate\Foundation\Http\FormRequest;

class CreateProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Provider::class);
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
