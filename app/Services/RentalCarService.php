<?php

namespace App\Services;

use App\Http\Requests\RentalCarInsertRequest;
use App\Models\RentalCar;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RentalCarService
{
    public function getAll()
    {
        return RentalCar::all();
    }

    public function addRentalCar(Request $request)
    {
        $request = RentalCarInsertRequest::createFrom($request);
        $rules = $request->rules();
        try {
            $request->validate($rules);
            $car = RentalCar::create([
                'name' => $request->name,
                'user_id' => 2
            ]);
            $car->save();

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }

        return $car;
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
            $rentalCar->update([
                'name' => $request->name ?? $rentalCar->name
            ]);
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
        $rentalCar->delete();
        return response(content: "Car removed successfully", status: 204);
    }
}
