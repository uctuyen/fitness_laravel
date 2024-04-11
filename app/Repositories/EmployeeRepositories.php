<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoriesInterface;
use App\Repositories\BaseRepositories;
/**
 * Class EmployeeService
 * @package App\Services
 */
class EmployeeRepositories extends BaseRepositories implements EmployeeRepositoriesInterface
{
    protected $model;
    public function __construct(
        Employee $model  
    ){
        $this->model = $model;
    }
   
    
}
