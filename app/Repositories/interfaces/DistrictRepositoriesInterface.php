<?php

namespace App\Repositories\Interfaces;

interface DistrictRepositoriesInterface {
    public function all();
    public function findDistrictProvinceID(int $province_id);
}