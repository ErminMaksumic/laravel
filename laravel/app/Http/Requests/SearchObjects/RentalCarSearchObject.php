<?php

namespace App\Http\Requests\SearchObjects;

class RentalCarSearchObject extends BaseSearchObject
{

    public ?string $name;
    public ?float $price;
    public ?bool $includeUser;

    public function __construct(array $attributes)
    {
       $this->fill($attributes);
    }

    public function fill(array $attributes)
    {
        parent::fill($attributes);
        $this->name = $attributes['name'] ?? null;
        $this->price = $attributes['price'] ?? null;
        $this->includeUser = $attributes['includeUser'] ?? null;
    }
}
