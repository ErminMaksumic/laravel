<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Traits\CanLoadRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    use CanLoadRelationships;

    protected array $relations = [];

    abstract protected function getModelClass(): string;

    public function getAll(array $searchParams = []): LengthAwarePaginator
    {
        $requestParams = request()->all();
        $filteredSearchParams = array_intersect_key($requestParams, array_flip($searchParams));
        $query = $this->loadRelationships($this->getModelInstance()->query(), $this->relations);
        return $this->filterQuery($filteredSearchParams, $query)->paginate();

    }

    public function add($data): Model
    {
        return $this->getModelInstance()->create($data);
    }

    public function update(int $id, $data): Model
    {
        $model = $this->getModelInstance()->find($id);

        if (!$model) {
            abort(404, 'Resource not found');
        }

        $model->update([$data]);

        return $model;
    }

    public function delete(int $id)
    {
        $model = $this->getModelInstance()->find($id);

        if(!$model)
        {
            abort(404, "Resource not found");
        }

        $model->delete();
    }

    public function getById(int $id): Model
    {
        $result = $this->getModelInstance()->find($id);

        if(!$result)
        {
            abort(404, "Resource not found");
        }

        return $result;
    }

    protected function getModelInstance(): Model
    {
        $modelClass = $this->getModelClass();

        return new $modelClass;
    }

    protected function filterQuery(array $filteredSearchParams, $query) :  Builder
    {
        foreach ($filteredSearchParams as $key => $value) {
            if ($value !== null) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        return $query;
    }
}
