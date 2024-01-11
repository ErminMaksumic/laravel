<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationInsertRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Services\ReservationService;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $reservationService)
    { }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return ReservationResource::collection($this->reservationService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationInsertRequest $request)
    {
        return ReservationResource::make($this->reservationService->addRentalCar($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return ReservationResource::make($this->reservationService->getById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationInsertRequest $request, int $id)
    {
        return ReservationResource::make($this->reservationService->updateReservation($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $this->reservationService->removeReservation($reservation);
    }
}
