<?php

namespace App\Http\Requests\PaymentType;

use App\PaymentType;
use Illuminate\Foundation\Http\FormRequest;

class RestorePaymentTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $payment_type = PaymentType::withTrashed()->findOrFail($this->route('id'));
        return $this->user()->can('restore', $payment_type);
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
