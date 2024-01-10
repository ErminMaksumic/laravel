<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalCarInsertRequest;
use App\Http\Resources\RentalCarResource;
use App\Models\RentalCar;
use App\Services\RentalCarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RentalCarController extends Controller
{

    /**swagger specification*/

    /**
     * @OA\Info(
     *    title="Swagger",
     *    description="Learning laravel",
     *    version="1.0.0",
     * )
     * @OA\Get(
     *      path="/api/rentalCar",
     *      summary="Get all rental cars",
     *      tags={"Rental Cars"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
     * @OA\Post(
     *      path="/api/rentalCar",
     *      summary="Create a new rental car",
     *      tags={"Rental Cars"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Rental Car data",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      description="Name of the rental car",
     *                      type="string",
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
     * @OA\Get(
     *      path="/api/rentalCar/{id}",
     *      summary="Get a specific rental car by ID",
     *      tags={"Rental Cars"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the rental car",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
     * @OA\Get(
     *       path="/api/rentalCar/prices",
     *       summary="Get all prices",
     *       tags={"Prices"},
     *       @OA\Response(
     *           response=200,
     *           description="Successful operation",
     *       ),
     *  )
     * @OA\Put(
     *      path="/api/rentalCar/{id}",
     *      summary="Update a specific rental car by ID",
     *      tags={"Rental Cars"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the rental car",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Updated Rental Car data",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      description="Updated name of the rental car",
     *                      type="string",
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
     * @OA\Delete(
     *      path="/api/rentalCar/{id}",
     *      summary="Delete a specific rental car by ID",
     *      tags={"Rental Cars"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the rental car",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
     */

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

    public function show(RentalCar $rentalCar) : RentalCarResource
    {
       return RentalCarResource::make($this->rentalCarService->getById($rentalCar));
    }

    public function update(RentalCarInsertRequest $request, RentalCar $rentalCar) : JsonResponse | RentalCar | RentalCarResource
    {
        return RentalCarResource::make($this->rentalCarService->updateRentalCar($request, $rentalCar));
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

