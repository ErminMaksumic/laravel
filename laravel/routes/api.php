<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RentalCarController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// auth
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware("auth:sanctum");

// Resource route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) { return $request->user(); });
Route::get('rentalCar/prices', [RentalCarController::class, 'getAllPrices']);
Route::apiResource('rentalCar', RentalCarController::class);
Route::apiResource('reservation', ReservationController::class);
Route::apiResource('payment', PaymentController::class);

Route::get('/payment/{id}/allowedActions', [PaymentController::class, 'allowedActions'])->name('payment.allowedActions');
Route::put('/payment/{containerId}/changeState/{statusId}', [PaymentController::class, 'changeState'])->name('payment.changeState');
