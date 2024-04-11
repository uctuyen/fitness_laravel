<?php

namespace App\Repositories;

use App\Models\Trainer;
use App\Repositories\Interfaces\TrainerRepositoriesInterface;
use App\Repositories\BaseRepositories;
/**
 * Class TrainerService
 * @package App\Services
 */
class TrainerRepositories extends BaseRepositories implements TrainerRepositoriesInterface
{
    protected $model;
    public function __construct(
        Trainer $model  
    ){
        $this->model = $model;
    }
   
    
}
