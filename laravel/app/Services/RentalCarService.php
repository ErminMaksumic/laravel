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

    public function addFilter($searchObject, $included){

        if ($searchObject->name) {
            $included = $included->where('name', $searchObject->name);
        }

        if ($searchObject->price) {
            $included = $included->where('price', $searchObject->price);
        }

        return $included;
    }

    public function includeRelation($searchObject){
        $rentalCars = $this->getRepository()->getAll();

        if ($searchObject->includeUser) {
            $rentalCars = $rentalCars->load('user');
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
