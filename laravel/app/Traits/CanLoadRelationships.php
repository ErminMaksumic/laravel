<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait CanLoadRelationships
{
    public function loadRelationships(
        Model|QueryBuilder|EloquentBuilder|HasMany $for,
        array $relations = null
    )
    {
        $relations = $relations ?? $this->relations ?? [];

        foreach ($relations as $relation){
            $for->when(
                $this->shouldIncludeRelation($relation), fn($q) => $for instanceof Model ? $for->load($relation):
                $q->with($relation)
            );
        }

        return $for;
    }

    protected function shouldIncludeRelation(string $relation): bool
    {
        $include = request()->query('include');

        if(!$include){
            return false;
        }

        //$relations = explode(',', $include); -> create an array
        $relations = array_map('trim', explode(',', $include)); // remove spaces if someone accidentally put it

        return in_array($relation, $relations);
    }
}
