<?php

namespace App\Services;

use App\Http\Requests\ReservationInsertRequest;
use App\Repositories\ReservationRepository;
use Illuminate\Validation\ValidationException;

class ReservationService
{
    public function __construct(protected ReservationRepository $reservationRepository)
    { }

    public function getAll()
    {
        $searchParams = [
            'name' => request('search'),
        ];

        return $this->reservationRepository->getAll($searchParams);
    }

    public function addRentalCar(ReservationInsertRequest $request)
    {
        try {
            return $this->reservationRepository->add($request);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }
    }

    public function getById(int $id)
    {
        return $this->reservationRepository->getById($id);
    }

    public function updateReservation(ReservationInsertRequest $request, int $id)
    {
        $rules = ['name' => 'sometimes|string'];
        try {
            $request->validate($rules);
            $updatedReservation = $this->reservationRepository->update($id, $request);
        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }

        return $updatedReservation;
    }

    public function removeReservation(int $id)
    {
        $this->reservationRepository->delete($id);
        return response(content: "Car removed successfully", status: 204);
    }
}
