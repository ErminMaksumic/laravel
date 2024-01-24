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
    public function __construct(protected PaymentServiceInterface $paymentService,
                                protected PaymentStateMahineService $containerStateMachineService,
                                protected PaymentStateMahineService $paymentStateMachineService)
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

    public function paymentProcess(int $orderId)
    {
        return PaymentResource::make($this->paymentStateMachineService->paymentProcess($orderId));
    }

    public function paymentApprove(int $orderId)
    {
        return PaymentResource::make($this->paymentStateMachineService->paymentApprove($orderId));
    }

    public function paymentReject(int $orderId)
    {
        return PaymentResource::make($this->paymentStateMachineService->paymentReject($orderId));
    }


}
