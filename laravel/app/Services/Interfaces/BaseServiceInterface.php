<?php

namespace App\Services\Interfaces;

interface BaseServiceInterface
{
    public function getRepository();
    public function getAll();
    public function getById(int $id);
    public function add(array $request);
    public function update(array $request, int $id);
    public function remove(int $id);
}
