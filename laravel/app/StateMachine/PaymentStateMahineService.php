<?php

namespace App\StateMachine;

use App\Exceptions\ErrorFilter;
use App\Models\Payment;
use App\Services\Interfaces\PaymentServiceInterface;
use App\StateMachine\Config\StateConfiguration;
use App\StateMachine\Enums\PaymentStatus;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PaymentStateMahineService
{

    public function __construct(protected StateConfiguration $stateConfiguration, protected PaymentServiceInterface $paymentService)
    { }
    public function allowedActions(int $id)
    {
        $payment = Payment::query()->find($id);
        if (!$payment) {
            throw new Exception("Payment not found");
        }

        $status = PaymentStatus::from($payment->status);

        if ($status === null) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $state = $this->stateConfiguration->stateMap()[$status->name];
        return $state->allowedActions();
    }


    public function updatePayment(PaymentStatus $paymentStatus, int $paymentId)
    {
        $payment = $this->paymentService->getById($paymentId);
        $collection = collect($this->allowedActions($paymentId));
        if ($collection->contains('value', $paymentStatus->value)) {
            $payment = $this->paymentService->update(['status' => $paymentStatus], $paymentId);
        } else {
            throw new Exception("Status update not allowed!");
        }

        return $payment;
    }

    public function paymentProcess(int $paymentId)
    {
       return  $this->updatePayment(PaymentStatus::PROCESSING, $paymentId);
    }

    public function paymentApprove(int $paymentId)
    {
        return  $this->updatePayment(PaymentStatus::APPROVED, $paymentId);
    }
    public function paymentReject(int $paymentId)
    {
        return  $this->updatePayment(PaymentStatus::REJECTED, $paymentId);
    }
}
