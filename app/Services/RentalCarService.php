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

    public function addRentalCar(Request $request)
    {
        $request = RentalCarInsertRequest::createFrom($request);
        $rules = $request->rules();
        try {
            $request->validate($rules);
            return $this->_rentalCarRepository->addRentalCar($request);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }
    }

    public function getById(RentalCar $rentalCar)
    {
        return $rentalCar->load("user");
    }

    public function updateRentalCar(Request $request, RentalCar $rentalCar)
    {
        $request = RentalCarInsertRequest::createFrom($request);
        $rules = ['name' => 'sometimes|string'];
        try {
            $request->validate($rules);
            $this->_rentalCarRepository->updateRentalCar($rentalCar, $request);
        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }

        return $rentalCar;
    }

    public function removeRentalCar(RentalCar $rentalCar)
    {
        $this->_rentalCarRepository->deleteRentalCar($rentalCar);
        return response(content: "Car removed successfully", status: 204);
    }
}
