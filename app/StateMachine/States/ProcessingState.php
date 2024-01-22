<?php

namespace App\StateMachine\States;

use App\StateMachine\Enums\PaymentStatus;

class ProcessingState
{
    public function allowedActions()
    {
        return [
                PaymentStatus::APPROVED,
                PaymentStatus::REJECTED,
                PaymentStatus::CANCELED
        ];
    }
}
