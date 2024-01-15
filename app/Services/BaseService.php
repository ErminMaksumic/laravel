<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class BaseService implements BaseServiceInterface
{
    protected function handleValidationException(ValidationException $e)
    {
        $errors = $e->validator->errors();
        $errorArray = $errors->toArray();

        return response()->json([
            'errors' => $errorArray,
        ], 422);
    }

    protected function handleDeleteResponse()
    {
        return response(content: "Resource removed successfully", status: 204);
    }


    public function getAll(array $searchParams)
    {
        return $this->getRepository()->getAll($searchParams);
    }

    public function getById(int $id)
    {
        return $this->getRepository()->getById($id);
    }

    public function add(array $request)
    {
        try {
            return $this->getRepository()->add($request);
        } catch (ValidationException $e) {
            return $this->handleValidationException($e);
        }
    }

    public function update(array $request, int $id)
    {
        try {
            $updatedItem = $this->getRepository()->update($id, $request);
        } catch (ValidationException $e) {
            return $this->handleValidationException($e);
        }

        return $updatedItem;
    }

    public function remove(int $id)
    {
        $this->getRepository()->delete($id);
        return $this->handleDeleteResponse();
    }

    protected function updateValidationRules(): array
    {
        return [];
    }
}
