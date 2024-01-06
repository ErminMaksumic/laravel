<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalCarInsertRequest;
use App\Models\RentalCar;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;

class RentalCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RentalCar::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = RentalCarInsertRequest::createFrom($request);
        $rules = $request->rules();
        try {
            $this->validate($request, $rules);
            $car = RentalCar::create([
                'name' => $request->name
            ]);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $errorArray = $errors->toArray();

            return response()->json([
                'errors' => $errorArray,
            ], 422);        }

        return $car;
   }

    /**
     * Display the specified resource.
     */
    public function show(RentalCar $rentalCar)
    {
        return $rentalCar;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RentalCar $rentalCar)
    {
        $request = RentalCarInsertRequest::createFrom($request);
        $rules = ['name' => 'sometimes|string'];
        try {
            $this->validate($request, $rules);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
