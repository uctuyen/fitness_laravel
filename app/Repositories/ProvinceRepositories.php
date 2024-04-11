<?php

namespace App\Repositories;

use App\Models\Province;
use App\Repositories\Interfaces\ProvinceRepositoriesInterface;
use App\Repositories\BaseRepositories;


class provinceRepositories extends BaseRepositories implements ProvinceRepositoriesInterface{
    protected $model;
    public function __construct(
        Province $model  
    ){
        $this->model = $model;
    }
}