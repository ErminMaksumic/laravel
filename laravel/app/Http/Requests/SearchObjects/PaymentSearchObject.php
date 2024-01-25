<?php

namespace App\Http\Requests\SearchObjects;

class PaymentSearchObject extends BaseSearchObject
{
    public ?bool $includeReservation;

    public function __construct(array $attributes)
    {
        parent::fill($attributes);
    }

    public function fill(array $attributes)
    {
        parent::fill($attributes);
        $this->includeReservation = $attributes['includeReservation'] ?? null;
    }
}
