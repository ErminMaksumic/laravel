<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RentalCarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
                'id' => $this->id,
                'name' => $this->name,
                'price' => $this->price,
                'user' => new UserResource($this->whenLoaded('user')),
        ];
    }

    /**
     * Add pagination information to the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function with($request): array
    {
        return [
            'meta' => [
                'count' => $this->collection->count(), // Dodajte ovdje broj rezultata
            ],
        ];
    }

}
