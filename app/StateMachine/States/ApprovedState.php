<?php

namespace App\StateMachine\States;

class ApprovedState extends BaseState
{
    public function allowedActions()
    {
        return [];
    }
}
