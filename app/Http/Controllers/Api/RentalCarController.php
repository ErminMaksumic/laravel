<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RentalCarInsertRequest;
use App\Http\Requests\RentalCarUpdateRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\RentalCarResource;
use App\Services\Interfaces\RentalCarServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RentalCarController extends BaseController
{
    public function __construct(RentalCarServiceInterface $rentalCarService)
    {
        parent::__construct($rentalCarService);
        $this->middleware('auth:sanctum')->except(['index']);
    }

    public function getInsertRequestClass()
    {
        return RentalCarInsertRequest::class;
    }

    public function getUpdateRequestClass()
    {
        return RentalCarUpdateRequest::class;
    }

    public function createResourcePayload($request, $collection = false) : RentalCarResource | AnonymousResourceCollection
    {
        if($collection)
        {
            return RentalCarResource::collection($request);
        }

        return new RentalCarResource($request);
    }
}
