<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\Interfaces\DistrictRepositoriesInterface;

class DistrictRepositories extends BaseRepositories implements DistrictRepositoriesInterface
{
    protected $model;

    public function __construct(
        District $model
    ) {
        $this->model = $model;
    }

    public function findDistrictProvinceID(int $province_id = 0)
    {
        return $this->model->where('province_code', '=', $province_id)->get();
    }
}
