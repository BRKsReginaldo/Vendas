<?php

namespace App\Http\Requests\Client;

use App\Client;
use Illuminate\Foundation\Http\FormRequest;

class EnableClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $client = Client::withTrashed()->findOrFail($this->route('id'));
        return $this->user()->can('enable', $client);
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
