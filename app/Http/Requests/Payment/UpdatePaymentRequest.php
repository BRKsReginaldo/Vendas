<?php

namespace App\Http\Requests\Payment;

use App\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->getModel('payment', Payment::class));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $model = $this->getModel('payment', Payment::class);
        $max = $model->total_plots;
        return [
            'pending_plots' => "required|numeric|max:$max",
            'paid_plots' => "required|numeric|max:$max",
            'payed_at' => 'nullable|date',
        ];
    }
}
