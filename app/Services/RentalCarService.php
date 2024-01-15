<?php

namespace App\Services;

use App\Repositories\RentalCarRepository;
use App\Services\Interfaces\RentalCarServiceInterface;

class RentalCarService extends BaseService implements RentalCarServiceInterface
{
    private array $availableSearchParams = ['name', 'price'];

    public function getRepository()
    {
        return app(RentalCarRepository::class);
    }

    public function getAllPrices()
    {
        return $this->getRepository()->getAllPrices();
    }

    public function getAllSearch()
    {
        return parent::getAll($this->availableSearchParams);
    }
}
