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
 *  reservations
 * @OA\Get(
 *       path="/api/reservation",
 *       summary="Get all reservations",
 *       tags={"Reservations"},
 *       @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *       ),
 *  )
 * @OA\Get(
 *       path="/api/reservation/{id}",
 *       summary="Get a specific reservations by ID",
 *       tags={"Reservations"},
 *       @OA\Parameter(
 *           name="id",
 *           in="path",
 *           required=true,
 *           description="ID of the reservation",
 *           @OA\Schema(
 *               type="integer",
 *           ),
 *       ),
 *       @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *       ),
 *  )
 * @OA\Delete(
 *       path="/api/reservation/{id}",
 *       summary="Delete a specific reservation by ID",
 *       tags={"Reservations"},
 *       @OA\Parameter(
 *           name="id",
 *           in="path",
 *           required=true,
 *           description="ID of the reservation",
 *           @OA\Schema(
 *               type="integer",
 *           ),
 *       ),
 *       @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *       ),
 *  )
 * @OA\Put(
 *       path="/api/reservation/{id}",
 *       summary="Update a specific reservation by ID",
 *       tags={"Reservations"},
 *       @OA\Parameter(
 *           name="id",
 *           in="path",
 *           required=true,
 *           description="ID of the reservation",
 *           @OA\Schema(
 *               type="integer",
 *           ),
 *       ),
 *       @OA\RequestBody(
 *           required=true,
 *           description="Updated Rental Car data",
 *           @OA\MediaType(
 *               mediaType="application/json",
 *               @OA\Schema(
 *                   type="object",
 *                   @OA\Property(
 *                       property="from",
 *                       description="From date",
 *                       type="datetime",
 *                       default="2022-11-02 19:24:49",
 *                   ),
 *                  @OA\Property(
 *                        property="to",
 *                        description="To date",
 *                        type="datetime",
 *                        default="2025-11-02 19:24:49",
 *                    ),
 *               ),
 *           ),
 *       ),
 *       @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *       ),
 *  )
 * @OA\Post(
 *        path="/api/reservation",
 *        summary="Post a specific reservation by ID",
 *        tags={"Reservations"},
 *        @OA\RequestBody(
 *            required=true,
 *            description="Create Rental Car",
 *            @OA\MediaType(
 *                mediaType="application/json",
 *                @OA\Schema(
 *                    type="object",
 *                    @OA\Property(
 *                         property="from",
 *                         description="From date",
 *                         type="datetime",
 *                         default="2022-11-02 19:24:49",
 *                     ),
 *                    @OA\Property(
 *                        property="user_id",
 *                        description="User ID",
 *                        type="int",
 *                    ),
 *                    @OA\Property(
 *                         property="rental_car_id",
 *                         description="Rental Car ID",
 *                         type="int",
 *                     ),
 *                   @OA\Property(
 *                         property="to",
 *                         description="To date",
 *                         type="datetime",
 *                         default="2025-11-02 19:24:49",
 *                     ),
 *                ),
 *            ),
 *        ),
 *        @OA\Response(
 *            response=200,
 *            description="Successful operation",
 *        ),
 *   )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
