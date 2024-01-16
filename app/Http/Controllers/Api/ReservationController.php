<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ReservationInsertRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Resources\ReservationResource;
use App\Services\Interfaces\ReservationServiceInterface;

class ReservationController extends BaseController
{

    public function __construct(ReservationServiceInterface $reservationService)
    {
        parent::__construct($reservationService);
    }

    public function getInsertRequestClass()
    {
        return ReservationInsertRequest::class;
    }

    public function getUpdateRequestClass()
    {
        return ReservationUpdateRequest::class;
    }

    public function createResourcePayload($request)
    {
        return new ReservationResource($request);
    }
}
