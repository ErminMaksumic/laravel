<?php

namespace App\Repositories;

use App\Models\RentalCar;
use App\Models\User;
use App\Repositories\Interfaces\RentalCarRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RentalCarRepository extends BaseRepository implements RentalCarRepositoryInterface
{
    protected array $relations = ['user'];

    public function getAllPrices(): int
    {
        $user = User::with('RentalCars')->find(1);
        return $user->rentalCars->sum('price');
    }

    public function add($data): Model
    {
        return RentalCar::create([
            'name' => $data['name'],
            'user_id' => $data['user_id'],
            'price' => $data['price']
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
            'name' => $data['name'],
            'price' => $data['price']
        ]);

        return $rentalCar;
    }

    protected function getModelClass(): string
    {
        return RentalCar::class;
    }
}
