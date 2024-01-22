<?php

namespace App\StateMachine\States;

class CanceledState
{
    public function allowedActions()
    {
        return [];
    }
}
