<?php

namespace App\Repositories;

use App\Http\Requests\RentalCarInsertRequest;
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

    public function update(int $id, $data): Model
    {
        $rentalCar = RentalCar::query()->find($id);

        if(!$rentalCar)
        {
            abort(404, 'Rental Car not found');
        }

        $rentalCar->update([
            'name' => $data->name,
            'price' => $data->price
        ]);

        return $rentalCar;
    }

    protected function getModelClass(): string
    {
        return RentalCar::class;
    }

}
