<?php

namespace App\StateMachine\Enums;

enum PaymentStatus: int {
    case PROCESSING = 1;
    case APPROVED = 2;
    case CANCELED = 3;
    case REJECTED = 4;

}
