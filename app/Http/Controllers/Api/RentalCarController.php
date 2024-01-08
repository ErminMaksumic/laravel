<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RentalCar;
use App\Services\RentalCarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentalCarController extends Controller
{
    public RentalCarService $_rentalCarService;

    public function __construct(RentalCarService $rentalCarService)
    {
        $this->_rentalCarService = $rentalCarService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : \Illuminate\Database\Eloquent\Collection
    {
        return $this->_rentalCarService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RentalCar
    {
       return $this->_rentalCarService->addRentalCar($request);
   }

    /**
     * Display the specified resource.
     */
    public function show(RentalCar $rentalCar) : RentalCar
    {
       return $this->_rentalCarService->getById($rentalCar);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RentalCar $rentalCar) : JsonResponse | RentalCar
    {
        return $this->_rentalCarService->updateRentalCar($request, $rentalCar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RentalCar $rentalCar)
    {
        return $this->_rentalCarService->removeRentalCar($rentalCar);
    }
}
