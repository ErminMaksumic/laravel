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
        $searchObjectInstance = app($this->getSearchObject());
        $searchObjectInstance->fill(request()->query());

        $query = app($this->getModelClass())->query();

        if ($searchObjectInstance->page && $searchObjectInstance->size) {
            $query->skip(($searchObjectInstance->page - 1) * $searchObjectInstance->size)->take($searchObjectInstance->size);
        }

        $query = $this->includeRelation($searchObjectInstance, $query);
        $query = $this->addFilter($searchObjectInstance, $query);

        return $query->get();
    }


    public function getById(int $id)
    {
        $query = app($this->getModelClass())->query();
        $query->where('id', $id);

        $searchObjectInstance = app($this->getSearchObject());
        $query = app($this->getModelClass())->query();

        $searchObjectInstance->fill(request()->query());
        $query = $this->includeRelation($searchObjectInstance, $query);
        $query = $this->addFilter($searchObjectInstance, $query);

        return $query->first();

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

    public function addFilter($searchObject, $query){
        return $query;
    }

    public function getSearchObject()
    {
        return BaseSearchObject::class;
    }

    public function includeRelation($searchObject, $query)
    {
        return $query;
    }

}
