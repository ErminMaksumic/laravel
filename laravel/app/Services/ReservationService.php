<?php

namespace App\Services;

use App\Http\Requests\SearchObjects\ReservationSearchObject;
use App\Models\Reservation;
use App\Repositories\ReservationRepository;
use App\Services\Interfaces\ReservationServiceInterface;

class ReservationService extends BaseService implements ReservationServiceInterface
{
    public function getRepository()
    {
        return app(ReservationRepository::class);
    }

    public function getSearchObject()
    {
        return ReservationSearchObject::class;
    }

    protected function getModelClass()
    {
        return Reservation::class;
    }

    public function addFilter($searchObject, $included){

        if ($searchObject->from) {
            $included = $included->where('from', $searchObject->from);
        }

        if ($searchObject->to) {
            $included = $included->where('to', $searchObject->to);
        }

        return $included;
    }

    public function includeRelation($searchObject){
        $rentalCars = $this->getRepository()->getAll();

        if ($searchObject->includeUser) {
            $rentalCars = $rentalCars->load('user');
        }

        if ($searchObject->includeRentalCar) {
            $rentalCars = $rentalCars->load('rentalCar');
        }

        if ($searchObject->includePayment) {
            $rentalCars = $rentalCars->load('payment');
        }

        return $rentalCars;
    }

}
