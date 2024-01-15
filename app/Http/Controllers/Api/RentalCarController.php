<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalCarInsertRequest;
use App\Http\Requests\RentalCarUpdateRequest;
use App\Http\Resources\RentalCarResource;
use App\Models\RentalCar;
use App\Services\Interfaces\RentalCarServiceInterface;
use App\Traits\CanLoadRelationships;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class RentalCarController extends Controller
{

    use CanLoadRelationships;

    private array $relations = ['user'];

    public function __construct(protected RentalCarServiceInterface $rentalCarService)
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(): AnonymousResourceCollection {
        return RentalCarResource::collection($this->rentalCarService->getAll());
    }

    public function store(Request $request): RentalCarResource|JsonResponse
    {
        $validatedData = $this->validateRequest($request, RentalCarInsertRequest::class);
        return RentalCarResource::make($this->rentalCarService->add($validatedData));
    }

    public function show(int $id): RentalCarResource
    {
        return RentalCarResource::make($this->loadRelationships($this->rentalCarService->getById($id), $this->relations));
    }

    public function update(Request $request, int $id): JsonResponse|RentalCar|RentalCarResource
    {
        $validatedData = $this->validateRequest($request, RentalCarUpdateRequest::class);
        return RentalCarResource::make($this->rentalCarService->update($validatedData, $id));
    }

    public function destroy(int $id)
    {
        return $this->rentalCarService->remove($id);
    }

    public function getAllPrices(): int
    {
        return $this->rentalCarService->getAllPrices();
    }
}

