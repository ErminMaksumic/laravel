<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PaymentInsertRequest;
use App\Http\Requests\PaymentUpdateRequest;
use App\Http\Resources\PaymentResource;
use App\Services\Interfaces\PaymentServiceInterface;
use App\StateMachine\PaymentStateMahineService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends BaseController
{
    public function __construct(PaymentServiceInterface $paymentService, protected PaymentStateMahineService $containerStateMachineService)
    {
        parent::__construct($paymentService);
    }

    public function getInsertRequestClass()
    {
        return PaymentInsertRequest::class;
    }

    public function getUpdateRequestClass()
    {
        return PaymentUpdateRequest::class;
    }

    public function createResourcePayload($request, $collection = false) : PaymentResource | AnonymousResourceCollection
    {
        if($collection)
        {
            return PaymentResource::collection($request);
        }

        return new PaymentResource($request);
    }

    public function allowedActions(int $id)
    {
        return $this->containerStateMachineService->allowedActions($id);
    }

    public function changeState(int $paymentId, int $statusId)
    {
        return PaymentResource::make($this->containerStateMachineService->changeState($paymentId, $statusId));
    }

}
