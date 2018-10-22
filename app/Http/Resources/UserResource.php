<?php

namespace App\Http\Resources;

use App\Repositories\ImageRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => url('storage/' . $this->image),
            'image_small' => url('storage/' . resolve(ImageRepository::class)->urlForSize($this->image, 40, 40)),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'client_id' => $this->client_id,
            'client' => new ClientResource($this->whenLoaded('client'))
        ];
    }
}
