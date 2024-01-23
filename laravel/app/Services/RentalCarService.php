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

    public function addFilter($searchObject, $query){

        if ($searchObject->name) {
            $query = $query->where('name', $searchObject->name);
        }

        if ($searchObject->price) {
            $query = $query->where('price', $searchObject->price);
        }

        return $query;
    }

    public function includeRelation($searchObject, $query){
        if ($searchObject->includeUser) {
            $query = $query->with('user');
        }

        return $query;
    }

    public function getSearchObject()
    {
        return RentalCarSearchObject::class;
    }

    protected function getModelClass()
    {
        return RentalCar::class;
    }
}
