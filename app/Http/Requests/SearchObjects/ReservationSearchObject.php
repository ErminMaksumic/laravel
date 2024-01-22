<?php

namespace App\Http\Requests\SearchObjects;

class ReservationSearchObject extends BaseSearchObject
{
    public ?string $from;
    public ?string $to;

    public function __construct(array $attributes)
    {
        $this->from = $attributes['from'] ?? null;
        $this->to = $attributes['to'] ?? null;
    }

    public function fill(array $attributes)
    {
        $this->from = $attributes['from'] ?? null;
        $this->to = $attributes['to'] ?? null;
    }

    public function toArray()
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
        ];
    }
}
