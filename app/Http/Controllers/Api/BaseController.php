<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseController extends Controller
{
    public function __construct(protected $service)
    { }

    abstract function getInsertRequestClass();
    abstract function getUpdateRequestClass();

    public function index(): LengthAwarePaginator
    {
        return $this->service->getAllSearch();
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request, $this->getInsertRequestClass());
        return $this->createResourcePayload($this->service->add($validatedData));
    }

    public function validateRequest(Request $request, $formRequest)
    {
        try {
            $formRequestInstance = new $formRequest();
            $validatedData = $this->validate($request, $formRequestInstance->rules());
            return $validatedData;
        } catch (Illuminate\Validation\ValidationException $e) {
            return $this->handleValidationException($e);
        }
    }

    protected function handleValidationException(Illuminate\Validation\ValidationException $e)
    {
        $errors = $e->validator->errors();
        $errorArray = $errors->toArray();

        return response()->json([
            'errors' => $errorArray,
        ], 422);
    }


    public function createResourcePayload($request)
    {
        return AnonymousResourceCollection::collection($request);
    }

    public function show(int $id)
    {
        return $this->createResourcePayload($this->service->getById($id));
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $this->validateRequest($request, $this->getUpdateRequestClass());
        return $this->createResourcePayload($this->service->update($validatedData, $id));
    }

    public function destroy(int $id)
    {
        $this->service->remove($id);
    }
}
