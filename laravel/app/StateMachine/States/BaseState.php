<?php

namespace App\StateMachine\States;

use App\Exceptions\CustomException;

class BaseState
{
    public function store($request)
    {
        throw new CustomException("Not allowed");
    }

    public function update($request, int $id)
    {
        throw new CustomException("Not allowed");
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
                throw new CustomException("Action not allowed!");
        }
    }
}
