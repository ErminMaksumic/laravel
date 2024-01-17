<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalCarInsertRequest;
use App\Http\Requests\ReservationInsertRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Resources\ReservationResource;
use App\Services\Interfaces\ReservationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function __construct(protected ReservationServiceInterface $reservationService)
    {
    }

    public function index()
    {
        return ReservationResource::collection($this->reservationService->getAll());
    }

    public function store(Request $request)
    {
            $validatedData = $this->validateRequest($request, ReservationInsertRequest::class);
            return ReservationResource::make($this->reservationService->add($validatedData));
    }

    public function show(int $id)
    {
        return ReservationResource::make($this->reservationService->getById($id));
    }

    public function update(Request $request, int $id)
    {
            $validatedData = $this->validateRequest($request, ReservationUpdateRequest::class);
            return ReservationResource::make($this->reservationService->update($validatedData, $id));
    }

    public function destroy(int $id)
    {
        $this->reservationService->remove($id);
    }
}
