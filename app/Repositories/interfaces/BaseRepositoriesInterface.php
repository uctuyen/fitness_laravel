<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoriesInterface
{
    public function all();

    public function findById(int $id, array $relations = []);

    public function create(array $payload = []);

    public function update(int $id = 0, array $payload = []);

    public function delete(int $id = 0);

    public function paginate(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 20
    );
}
