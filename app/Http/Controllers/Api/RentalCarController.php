<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RentalCarInsertRequest;
use App\Http\Requests\RentalCarUpdateRequest;
use App\Http\Resources\RentalCarResource;
use App\Services\Interfaces\RentalCarServiceInterface;

class RentalCarController extends BaseController
{
    public function __construct(RentalCarServiceInterface $rentalCarService)
    {
        parent::__construct($rentalCarService);
    }

    public function getInsertRequestClass()
    {
        return RentalCarInsertRequest::class;
    }

    public function getUpdateRequestClass()
    {
        return RentalCarUpdateRequest::class;
    }

    public function createResourcePayload($request) : RentalCarResource
    {
        return new RentalCarResource($request);
    }
}
