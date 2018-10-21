<?php

namespace App\Http\Requests\Client;

use App\Client;
use Illuminate\Foundation\Http\FormRequest;

class ShowClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('show', $this->getModel('client', Client::class));
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
