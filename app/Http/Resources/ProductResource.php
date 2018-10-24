<?php

namespace App\Http\Resources;

use App\Repositories\ImageRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'client_id' => $this->client_id,
            'provider_id' => $this->provider_id,
            'buy_price' => $this->buy_price,
            'sell_price' => $this->sell_price,
            'stock' => $this->stock,
            'image' => url($this->image),
            'image_small' => url('storage/' . resolve(ImageRepository::class)->urlForSize($this->image, 100, 100)),
        ];
    }
}
