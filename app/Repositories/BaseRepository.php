<?php

namespace App\Repositories;

use App\Http\Traits\CanLoadRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    use CanLoadRelationships;

    protected array $relations = [];

    abstract protected function getModelClass(): string;

    public function getAll(array $searchParams = []): LengthAwarePaginator
    {
        $query = $this->loadRelationships($this->getModelInstance()->query(), $this->relations);

        foreach ($searchParams as $key => $value) {
            if ($value !== null) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        return $query->paginate();
    }

    public function add($data): Model
    {
//        dd($data);
        return $this->getModelInstance()->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->getModelInstance()->find($id);

        if (!$model) {
            abort(404, 'Resource not found');
        }

        $model->update($data);

        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();
    }

    public function getById(int $id): Model
    {
        return $this->getModelInstance()->find($id);
    }

    protected function getModelInstance(): Model
    {
        $modelClass = $this->getModelClass();

        return new $modelClass;
    }
}
