<?php

namespace App\Services;

use App\Http\Requests\RentalCarInsertRequest;
use App\Models\RentalCar;
use App\Repositories\RentalCarRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RentalCarService
{
    protected RentalCarRepository $_rentalCarRepository;

    public function __construct(RentalCarRepository $rentalCarRepository)
    {
        $this->_rentalCarRepository = $rentalCarRepository;
    }

    public function getAll()
    {
        return $this->_rentalCarRepository->getAllRentalCars();
    }

    public function addRentalCar(RentalCarInsertRequest $request)
    {
        try {
            return $this->_rentalCarRepository->addRentalCar($request);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }
    }

    public function getById(int $id)
    {
        return $this->_rentalCarRepository->getById($id);
    }

    public function updateRentalCar(RentalCarInsertRequest $request, int $id)
    {
        $rules = ['name' => 'sometimes|string'];
        try {
            $request->validate($rules);
            $updatedRentalCar = $this->_rentalCarRepository->updateRentalCar($id, $request);
        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }

        return $updatedRentalCar;
    }

    public function removeRentalCar(RentalCar $rentalCar)
    {
        $this->_rentalCarRepository->deleteRentalCar($rentalCar);
        return response(content: "Car removed successfully", status: 204);
    }

    public function getAllPrices()
    {
        return $this->_rentalCarRepository->getAllPrices();
    }
}
