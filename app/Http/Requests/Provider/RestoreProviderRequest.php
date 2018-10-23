<?php

namespace App\Http\Requests\Provider;

use App\Provider;
use Illuminate\Foundation\Http\FormRequest;

class RestoreProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $provider = Provider::withTrashed()->findOrFail($this->route('id'));
        return $this->user()->can('restore', $provider);
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
