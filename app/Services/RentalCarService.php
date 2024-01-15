<?php

namespace App\Services;

use App\Repositories\RentalCarRepository;
use App\Services\Interfaces\RentalCarServiceInterface;

class RentalCarService extends BaseService implements RentalCarServiceInterface
{
    public function getRepository()
    {
        return app(RentalCarRepository::class);
    }

    public function getAllPrices()
    {
        return $this->getRepository()->getAllPrices();
    }
}
