<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rental_car_id' => $this->rental_car_id,
            'user_id' => $this->user_id,
            'from' => $this->from,
            'to' => $this->to,
            'user' => new UserResource($this->whenLoaded('user')),
            'rentalCar' => new RentalCarResource($this->whenLoaded('rentalCar')),
        ];
    }
}
