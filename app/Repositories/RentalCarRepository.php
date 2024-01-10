<?php

namespace App\Repositories;


use App\Http\Requests\RentalCarInsertRequest;
use App\Http\Resources\RentalCarResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\RentalCar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RentalCarRepository
{
    use CanLoadRelationships;

    private array $relations = ['user'];

    public function getAllRentalCars() : LengthAwarePaginator
    {
        $query = $this->loadRelationships(RentalCar::query(), $this->relations);

        $query->when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        });

        return $query->paginate();
    }

    public function addRentalCar(RentalCarInsertRequest $request) : RentalCar
    {
        return RentalCar::create([
            'name' => $request->name,
            'user_id' => 2,
            'price' => $request->price
        ]);
    }

    public function updateRentalCar(int $id, RentalCarInsertRequest $request) : Model
    {
        $rentalCar = RentalCar::query()->find($id);

        if(!$rentalCar)
        {
            abort(404, 'Rental Car not found');
        }

        $rentalCar->update([
            'name' => $request->name ?? $rentalCar->name,
            'price' => $request->price
        ]);

        return $rentalCar;
    }

    public function deleteRentalCar(RentalCar $rentalCar)
    {
        $rentalCar->delete();
    }

    public function getAllPrices() : int
    {
        return RentalCar::query()->sum('price');
    }

    public function getById(int $rentalCarId) : Model
    {
        return RentalCar::query()->find($rentalCarId);
    }
}
