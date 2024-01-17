<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Reservation;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    protected array $relations = ['user', 'reservation', 'reservation.user'];

    public function add($data): Model
    {
        $payment = Payment::create([
            'reservation_id' => $data['reservation_id'],
            'status' => $data['status'],
            'amount' => $data['amount']
        ]);

        if ($payment) {
            $reservation = Reservation::find($data['reservation_id']);

            $reservation->payment()->associate($payment);
            $reservation->save();
        }

        return $payment;
    }

    public function update(int $id, $data): Model
    {
        $payment = Payment::query()->find($id);

        if(!$payment)
        {
            abort(404, 'Rental Car not found');
        }

        $payment->update([
            'status' => $data['status'],
        ]);

        return $payment;
    }

    protected function getModelClass(): string
    {
        return Payment::class;
    }
}
