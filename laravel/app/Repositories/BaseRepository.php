<?php

namespace App\Repositories;

use App\Traits\CanLoadRelationships;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    use CanLoadRelationships;

    protected array $relations = [];

    abstract protected function getModelClass(): string;

    public function getAll()
    {
        $query = $this->getModelInstance()->query();
        return $query->get();
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

}
