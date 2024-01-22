<?php

namespace App\StateMachine\Enums;

enum PaymentStatus: string {
    case PROCESSING = 'PROCESSING';
    case APPROVED = 'APPROVED';
    case CANCELED = 'CANCELED';
    case REJECTED = 'REJECTED';

}
