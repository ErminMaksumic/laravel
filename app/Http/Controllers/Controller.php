<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
