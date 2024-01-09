<?php

namespace App\Repositories;


use App\Http\Requests\RentalCarInsertRequest;
use App\Models\RentalCar;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class RentalCarRepository
{
    public function getAllRentalCars() : Collection
    {
        return RentalCar::with('user')->get();
    }

    public function addRentalCar(RentalCarInsertRequest $request) : RentalCar
    {
        return RentalCar::create([
            'name' => $request->name,
            'user_id' => 2,
            'price' => 563
        ]);
    }

    public function updateRentalCar(RentalCar $rentalCar, RentalCarInsertRequest $request)
    {
        $rentalCar->update([
            'name' => $request->name ?? $rentalCar->name,
            'price' => 563
        ]);
    }

    public function deleteRentalCar(RentalCar $rentalCar)
    {
        $rentalCar->delete();
    }

    public function getAllPrices()
    {
        return RentalCar::query()->sum('price');
    }
}
