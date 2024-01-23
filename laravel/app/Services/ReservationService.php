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

    public function addFilter($searchObject, $query){

        if ($searchObject->from) {
            $query = $query->where('from', $searchObject->from);
        }

        if ($searchObject->to) {
            $query = $query->where('to', $searchObject->to);
        }

        return $query;
    }

    public function includeRelation($searchObject, $query){

        if ($searchObject->includeUser) {
            $query = $query->with('user');
        }

        if ($searchObject->includeRentalCar) {
            $query = $query->with('rentalCar');
        }

        if ($searchObject->includePayment) {
            $query = $query->with('payment');
        }

        return $query;
    }

}
