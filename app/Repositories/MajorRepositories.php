<?php

namespace App\Repositories;

use App\Models\Major;
use App\Repositories\Interfaces\MajorRepositoriesInterface;
use App\Repositories\BaseRepositories;
/**
 * Class MajorService
 * @package App\Services
 */
class MajorRepositories extends BaseRepositories implements MajorRepositoriesInterface
{
    protected $model;
    public function __construct(
        Major $model  
    ){
        $this->model = $model;
    }
   
    
}
