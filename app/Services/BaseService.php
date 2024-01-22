<?php

namespace App\Services;

use App\Http\Requests\SearchObjects\BaseSearchObject;
use App\Services\Interfaces\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{
    abstract protected function getModelClass();


    protected function handleDeleteResponse()
    {
        return response(content: "Resource removed successfully", status: 204);
    }

    public function getAll()
    {
        $searchObjectClass = $this->getSearchObject();
        $searchObjectInstance = app($searchObjectClass);

        $params = array_merge($searchObjectInstance->toArray(), request()->query());
        $searchObjectInstance->fill($params);
        return $this->addFilter($searchObjectInstance);
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

    public function addFilter($searchObject){
        return $this->getRepository()->getAll();
    }

    public function getSearchObject()
    {
        return BaseSearchObject::class;
    }

}
