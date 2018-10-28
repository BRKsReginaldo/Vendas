<?php

namespace App\Http\Requests\Payment;

use App\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Payment::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max = $this->request->get('total_plots', 0);
        $type = $this->request->get('payable_type', 'App\ProductBuy');
        $table = resolve($type)->getTable();
        return [
            'client_id' => 'required|exists:clients,id',
            'original_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'discount_percentage' => 'required|boolean',
            'price' => 'required|numeric',
            'payment_type_id' => 'required|exists:payment_types,id',
            'total_plots' => 'required|numeric',
            'pending_plots' => "required|numeric|max:$max",
            'paid_plots' => "required|numeric|max:$max",
            'payed_at' => 'nullable|date',
            'payable_type' => 'required|in:App\ProductBuy,App\OrderItem',
            'payable_id' => [
                'required',
                Rule::exists($table, 'id')
            ]
        ];
    }
}
