<?php

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepository extends BaseRepository
{
    protected array $relations = ['rentalCar', 'user'];

    protected function getModelClass(): string
    {
        return Reservation::class;
    }

    public function add($data): \Illuminate\Database\Eloquent\Model
    {
        return Reservation::create([
            'user_id' => $data->user_id,
            'rental_car_id' => $data->rental_car_id,
            'from' => $data->from,
            'to' => $data->to
        ]);
    }

    public function update(int $id, $data): \Illuminate\Database\Eloquent\Model
    {
        $reservation = Reservation::query()->find($id);

        if(!$reservation)
        {
            abort(404, 'Rental Car not found');
        }

        $reservation->update([
            'from' => $data->from,
            'to' => $data->to
        ]);

        return $reservation;
    }
}
