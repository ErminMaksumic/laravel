<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalCarInsertRequest;
use App\Models\RentalCar;
use App\Services\RentalCarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentalCarController extends Controller
{
    public RentalCarService $_rentalCarService;


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


    public function __construct(RentalCarService $rentalCarService)
    {
        $this->_rentalCarService = $rentalCarService;
    }

    public function index() : \Illuminate\Database\Eloquent\Collection
    {
        return $this->_rentalCarService->getAll();
    }

    public function store(RentalCarInsertRequest $request) : RentalCar
    {
       return $this->_rentalCarService->addRentalCar($request);
   }

    public function show(RentalCar $rentalCar) : RentalCar
    {
       return $this->_rentalCarService->getById($rentalCar);
    }

    public function update(RentalCarInsertRequest $request, RentalCar $rentalCar) : JsonResponse | RentalCar
    {
        return $this->_rentalCarService->updateRentalCar($request, $rentalCar);
    }


    public function destroy(RentalCar $rentalCar)
    {
        return $this->_rentalCarService->removeRentalCar($rentalCar);
    }


}

