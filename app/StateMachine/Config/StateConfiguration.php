<?php

namespace App\StateMachine\Config;

use App\StateMachine\Enums\PaymentStatus;
use App\StateMachine\States\ApprovedState;
use App\StateMachine\States\CanceledState;
use App\StateMachine\States\ProcessingState;
use App\StateMachine\States\RejectedState;

class StateConfiguration
{
    private $approvedState;
    private $processingState;
    private $canceledState;
    private $rejectedState;

    public function __construct(
        ApprovedState $approvedState,
        ProcessingState $processingState,
        CanceledState $canceledState,
        RejectedState $rejectedState
    ) {
        $this->approvedState = $approvedState;
        $this->canceledState = $canceledState;
        $this->processingState = $processingState;
        $this->rejectedState = $rejectedState;
    }

    public function stateMap()
    {
        return [
            PaymentStatus::PROCESSING->name => $this->processingState,
            PaymentStatus::APPROVED->name => $this->approvedState,
            PaymentStatus::REJECTED->name => $this->rejectedState,
            PaymentStatus::CANCELED->name => $this->canceledState,
        ];
    }
}
