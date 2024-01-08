<?php

namespace App\Repositories;


use App\Http\Requests\RentalCarInsertRequest;
use App\Models\RentalCar;
use Illuminate\Http\Client\Request;

class RentalCarRepository
{
    public function getAllRentalCars() : \Illuminate\Database\Eloquent\Collection
    {
        return RentalCar::all();
    }

    public function addRentalCar(RentalCarInsertRequest $request) : RentalCar
    {
        $car = RentalCar::create([
            'name' => $request->name,
            'user_id' => 2
        ]);
        $car->save();
        return $car;
    }

    public function updateRentalCar(RentalCar $rentalCar, RentalCarInsertRequest $request)
    {
        $rentalCar->update([
            'name' => $request->name ?? $rentalCar->name
        ]);
    }

    public function deleteRentalCar(RentalCar $rentalCar)
    {
        $rentalCar->delete();
    }
}
