<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{
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
      return $this->getRepository()->add($request);
    }

    public function update(array $request, int $id)
    {
        return $this->getRepository()->update($id, $request);
    }

    public function remove(int $id)
    {
        $this->getRepository()->delete($id);
        return $this->handleDeleteResponse();
    }
}
