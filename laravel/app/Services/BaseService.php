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

        $includedItems = $this->includeRelation($searchObjectInstance);
        return $this->addFilter($searchObjectInstance, $includedItems);
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

    public function addFilter($searchObject, $included){
        return $this->getRepository()->getAll();
    }

    public function getSearchObject()
    {
        return BaseSearchObject::class;
    }

    public function includeRelation($searchObject)
    {
        return [];
    }

}
