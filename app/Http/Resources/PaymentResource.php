<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'original_price' => $this->original_price,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_percentage' => $this->discount_percentage,
            'payment_type_id' => $this->payment_type_id,
            'total_plots' => $this->total_plots,
            'pending_plots' => $this->pending_plots,
            'paid_plots' => $this->paid_plots,
            'payed_at' => $this->payed_at,
            'paid' => $this->paid
        ];
    }
}
