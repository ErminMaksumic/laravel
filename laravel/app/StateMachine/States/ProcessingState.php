<?php

namespace App\StateMachine\States;

use App\Repositories\PaymentRepository;
use App\StateMachine\Enums\PaymentStatus;

class ProcessingState extends BaseState
{
    private $paymentRepository;
    public function __construct()
    {
        $this->paymentRepository = app(PaymentRepository::class);
    }
    public function store($request)
    {
        $request['status'] = 'PROCESSING';
        return $this->paymentRepository->add($request);
    }

    public function update($request, int $id)
    {
        return $this->paymentRepository->update($id, $request);
    }
    public function allowedActions()
    {
        return [
                PaymentStatus::APPROVED,
                PaymentStatus::REJECTED,
                PaymentStatus::CANCELED
        ];
    }
}
