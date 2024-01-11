<?php

namespace App\Repositories;

use App\Models\RentalCar;
use Illuminate\Database\Eloquent\Model;

class RentalCarRepository extends BaseRepository
{
    protected array $relations = ['user'];

    public function getAllPrices(): int
    {
        return RentalCar::query()->sum('price');
    }

    public function add($request): Model
    {
        return RentalCar::create([
            'name' => $request->name,
            'user_id' => 2,
            'price' => $request->price
        ]);
    }

    protected function getModelClass(): string
    {
        return RentalCar::class;
    }

}
