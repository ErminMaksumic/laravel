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

}
