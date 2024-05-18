<?php

namespace App\Repositories;

use App\Models\Trainer;
use App\Repositories\Interfaces\TrainerRepositoriesInterface;

/**
 * Class TrainerService
 */
class TrainerRepositories extends BaseRepositories implements TrainerRepositoriesInterface
{
    protected $model;

    public function __construct(
        Trainer $model
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
                    $query->where('first_name', 'like', '%'.$condition['keyword'].'%')
                        ->orWhere('last_name', 'like', '%'.$condition['keyword'].'%')
                        ->orWhere('email', 'like', '%'.$condition['keyword'].'%')
                        ->orWhere('address', 'like', '%'.$condition['keyword'].'%')
                        ->orWhere('phone_number', 'like', '%'.$condition['keyword'].'%');
                }
                if (isset($condition['gender']) && $condition['gender'] > 0) {
                    $query->where('gender', $condition['gender']);
                }
            });
        if (! empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function findByIdWithMajors($id)
    {
        return $this->model->with('majors')->find($id);
    }
}
