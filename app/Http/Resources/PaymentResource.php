<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $reservation = $this->whenLoaded('reservation');

        return [
            'amount' => $this->amount,
            'status' => $this->status,
            'reservation_id' => $this->reservation_id,
            'reservation' => $this->whenLoaded('reservation', function () {
                return new Reservation($this->reservation->toArray());
            }),        ];
    }
}
