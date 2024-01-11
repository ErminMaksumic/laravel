<?php

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepository extends BaseRepository
{
    protected array $relations = ['user', 'rentalCar'];

    protected function getModelClass(): string
    {
        return Reservation::class;
    }

    public function add($data): \Illuminate\Database\Eloquent\Model
    {
        return Reservation::create([
            'user_id' => $data->user_id,
            'rental_car_id' => $data->user_id,
            'from' => $data->from,
            'to' => $data->to
        ]);
    }
}
