<?php

namespace App\Http\Requests\SearchObjects;

class ReservationSearchObject extends BaseSearchObject
{
    public ?string $from;
    public ?string $to;
    public ?bool $includeRentalCar;
    public ?bool $includeUser;
    public ?bool $includePayment;

    public function __construct(array $attributes)
    {
        $this->from = $attributes['from'] ?? null;
        $this->to = $attributes['to'] ?? null;
        $this->includeRentalCar = $attributes['includeRentalCar'] ?? null;
        $this->includeUser = $attributes['includeUser'] ?? null;
        $this->includePayment = $attributes['includePayment'] ?? null;
    }

    public function fill(array $attributes)
    {
        parent::fill($attributes);
        $this->from = $attributes['from'] ?? null;
        $this->to = $attributes['to'] ?? null;
        $this->includeRentalCar = $attributes['includeRentalCar'] ?? null;
        $this->includeUser = $attributes['includeUser'] ?? null;
        $this->includePayment = $attributes['includePayment'] ?? null;
    }
}
