<?php

namespace App\StateMachine\States;

use Exception;

class BaseState
{
    public function store($request)
    {
        throw new Exception("Not allowed");
    }

    public function update($request, int $id)
    {
        throw new Exception("Not allowed");
    }

    static function CreateState($stateName)
    {
        switch ($stateName) {
            case ('PROCESSING'):
                return new ProcessingState();
            case ('APPROVED'):
                return new ApprovedState();
            case ('REJECTED'):
                return new RejectedState();
            default:
                throw new Exception("Action not allowed!");
        }
    }
}
