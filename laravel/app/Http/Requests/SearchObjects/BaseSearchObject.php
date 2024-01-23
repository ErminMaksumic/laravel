<?php

namespace App\Http\Requests\SearchObjects;

class BaseSearchObject
{
    public ?int $page;
    public ?int $size;

    public function __construct(array $attributes)
    {
        $this->page = $attributes['page'] ?? null;
        $this->size = $attributes['size'] ?? null;
    }

    public function fill(array $attributes)
    {
        $this->page = $attributes['page'] ?? null;
        $this->size = $attributes['size'] ?? null;
    }

    public function toArray()
    {
        return [
            'page' => $this->page,
            'size' => $this->size
        ];
    }
}
