<?php

namespace App\StateMachine;

use App\Models\Payment;
use App\StateMachine\Config\StateConfiguration;
use App\StateMachine\Enums\PaymentStatus;

class PaymentStateMahineService
{

    public function __construct(protected StateConfiguration $stateConfiguration)
    { }
    public function allowedActions(int $id)
    {
        $payment = Payment::query()->find($id);
        if (!$payment) {
            abort(404, 'Payment not found');
        }

        $status = PaymentStatus::from($payment->status);

        if ($status === null) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $state = $this->stateConfiguration->stateMap()[$status->name];
        $allowedActions = $state->allowedActions();

        return response()->json(['result' => $allowedActions]);
    }

    public function changeState(int $containerId, int $statusId)
    {
        $payment = Payment::query()->find($containerId);
        if (!$payment) {
            abort(404, 'Container not found');
        }

        $status = PaymentStatus::from($payment->status);

        if ($status === null) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $state = $this->stateConfiguration->stateMap()[$status->name];
        $allowedActions = $state->allowedActions();
        $collection = collect($allowedActions);

        if ($collection->contains('value', $statusId)) {
            $payment->update([
                'status' => $statusId
            ]);
        } else {
            abort(405, 'Update status not allowed!');
        }

        return $payment;
    }
}
