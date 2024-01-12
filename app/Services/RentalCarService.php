<?php

namespace App\Services;

use App\Http\Requests\RentalCarInsertRequest;
use App\Models\RentalCar;
use App\Repositories\RentalCarRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RentalCarService
{

    public function __construct(protected RentalCarRepository $rentalCarRepository)
    { }

    public function getAll()
    {
        $searchParams = [
            'name' => request('search'),
        ];

        return $this->rentalCarRepository->getAll($searchParams);
    }

    public function addRentalCar(RentalCarInsertRequest $request)
    {
        try {
            return $this->rentalCarRepository->add($request);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }
    }

    public function getById(int $id)
    {
        return $this->rentalCarRepository->getById($id);
    }

    public function updateRentalCar(RentalCarInsertRequest $request, int $id)
    {
        $rules = ['name' => 'sometimes|string'];
        try {
            $request->validate($rules);
            $updatedRentalCar = $this->rentalCarRepository->update($id, $request);
        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }

        return $updatedRentalCar;
    }

    public function removeRentalCar(int $id)
    {
        $this->rentalCarRepository->delete($id);
        return response(content: "Car removed successfully", status: 204);
    }

    public function getAllPrices()
    {
        return $this->rentalCarRepository->getAllPrices();
    }
}
