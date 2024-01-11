<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalCarInsertRequest;
use App\Http\Resources\RentalCarResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\RentalCar;
use App\Services\RentalCarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RentalCarController extends Controller
{

    use CanLoadRelationships;

    private array $relations = ['user'];



    public function __construct(protected RentalCarService $rentalCarService)
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index() : AnonymousResourceCollection
    {
        return RentalCarResource::collection($this->rentalCarService->getAll());
    }

    public function store(RentalCarInsertRequest $request) : RentalCarResource
    {
       return RentalCarResource::make($this->rentalCarService->addRentalCar($request));
   }

    public function show(int $id) : RentalCarResource
    {
       return RentalCarResource::make($this->loadRelationships($this->rentalCarService->getById($id), $this->relations));
    }

    public function update(RentalCarInsertRequest $request, int $id) : JsonResponse | RentalCar | RentalCarResource
    {
        return RentalCarResource::make($this->rentalCarService->updateRentalCar($request, $id));
    }

    public function destroy(RentalCar $rentalCar)
    {
        return $this->rentalCarService->removeRentalCar($rentalCar);
    }

    public function getAllPrices() : RentalCarResource
    {
        return new RentalCarResource([$this->rentalCarService->getAllPrices()]);
    }
}

