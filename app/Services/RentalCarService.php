<?php

namespace App\Services;

use App\Http\Requests\SearchObjects\RentalCarSearchObject;
use App\Models\RentalCar;
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

    public function addFilter($searchObject){
        $rentalCars = $this->getRepository()->getAll();

        if ($searchObject->name) {
            $rentalCars = $rentalCars->where('name', $searchObject->name);
        }

        if ($searchObject->price) {
            $rentalCars = $rentalCars->where('price', $searchObject->price);
        }

        return $rentalCars;
    }

    public function getSearchObject()
    {
        return RentalCarSearchObject::class;
    }

    protected function getModelClass()
    {
        return RentalCarSearchObject::class;
    }
}
