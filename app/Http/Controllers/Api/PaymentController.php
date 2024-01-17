<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PaymentInsertRequest;
use App\Http\Requests\PaymentUpdateRequest;
use App\Http\Resources\PaymentResource;
use App\Services\Interfaces\PaymentServiceInterface;

class PaymentController extends BaseController
{
    public function __construct(PaymentServiceInterface $paymentService)
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

    public function createResourcePayload($request) : PaymentResource
    {
        return new PaymentResource($request);
    }
}
