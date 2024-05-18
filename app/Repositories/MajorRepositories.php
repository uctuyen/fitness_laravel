<?php

namespace App\Repositories;

use App\Models\Major;
use App\Repositories\Interfaces\MajorRepositoriesInterface;

/**
 * Class MajorService
 */
class MajorRepositories extends BaseRepositories implements MajorRepositoriesInterface
{
    protected $model;

    public function __construct(
        Major $model
    ) {
        $this->model = $model;
    }

    public function paginate(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20,
    ) {
        $query = $this->model->select($column)
            ->where(function ($query) use ($condition) {
                if (isset($condition['keyword']) && ! empty($condition['keyword'])) {
                    $query->where('major_name', 'like', '%'.$condition['keyword'].'%');
                }
            });
        if (! empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
}
