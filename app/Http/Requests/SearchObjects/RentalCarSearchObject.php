<?php

namespace App\Http\Requests\SearchObjects;

class RentalCarSearchObject extends BaseSearchObject
{

    public ?string $name;
    public ?float $price;

    public function __construct(array $attributes)
    {
        $this->name = $attributes['name'] ?? null;
        $this->price = $attributes['price'] ?? null;
    }

    public function fill(array $attributes)
    {
        $this->name = $attributes['name'] ?? null;
        $this->price = $attributes['price'] ?? null;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
}
