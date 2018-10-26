<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductBuyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product' => new ProductResource($this->product),
            'product_id' => $this->product_id,
            'observations' => $this->observations,
            'client_id' => $this->client_id,
            'amount' => $this->amount,
            'payment' => new PaymentResource($this->payment)
        ];
    }
}
