<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationInsertRequest;
use App\Http\Resources\ReservationResource;
use App\Services\ReservationService;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $reservationService)
    { }

    public function index()
    {
       return ReservationResource::collection($this->reservationService->getAll());
    }

    public function store(ReservationInsertRequest $request)
    {
        return ReservationResource::make($this->reservationService->addRentalCar($request));
    }

    public function show(int $id)
    {
        return ReservationResource::make($this->reservationService->getById($id));
    }

    public function update(ReservationInsertRequest $request, int $id)
    {
        return ReservationResource::make($this->reservationService->updateReservation($request, $id));
    }

    public function destroy(int $id)
    {
        $this->reservationService->removeReservation($id);
    }
}
