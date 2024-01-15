<?php

namespace App\Services;

use App\Repositories\Interfaces\ReservationRepositoryInterface;
use App\Services\Interfaces\ReservationServiceInterface;

class ReservationService extends BaseService implements ReservationServiceInterface
{
    private array $availableSearchParams = ['from', 'to'];
    public function getRepository()
    {
        return app(ReservationRepositoryInterface::class);
    }

    public function getAllSearch()
    {
        return parent::getAll($this->availableSearchParams);
    }

}
