<?php

namespace App\StateMachine\States;

class RejectedState extends BaseState
{
    public function allowedActions()
    {
        return [];
    }
}
