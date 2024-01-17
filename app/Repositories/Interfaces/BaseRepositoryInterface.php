<?php

namespace App\Repositories\Interfaces;
interface BaseRepositoryInterface
{
    public function getAll(array $searchParams = []);
    public function add($data);
    public function update(int $id, $data);
    public function delete(int $id);
    public function getById(int $id);
}
