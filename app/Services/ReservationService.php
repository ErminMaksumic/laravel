<?php

namespace App\Services;

use App\Repositories\Interfaces\ReservationRepositoryInterface;
use App\Services\Interfaces\ReservationServiceInterface;

class ReservationService extends BaseService implements ReservationServiceInterface
{
    public function getRepository()
    {
        return app(ReservationRepositoryInterface::class);
    }


}
