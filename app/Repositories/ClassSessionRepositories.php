<?php

namespace App\Repositories;

use App\Models\ClassSession;
use App\Repositories\Interfaces\ClassSessionRepositoriesInterface;
use App\Repositories\BaseRepositories;
/**
 * Class MajorService
 * @package App\Services
 */
class ClassSessionRepositories extends BaseRepositories implements ClassSessionRepositoriesInterface
{
    protected $model;
    public function __construct(
        ClassSession $model  
    ){
        $this->model = $model;
    }
    public function paginate(
        array $column = ['*'], 
        array $condition =[], 
        array $join = [],
        array $extend = [],
        int $perPage = 20,
        ){
            $query = $this->model->select($column)
            ->where(function($query) use ($condition){
                if(isset($condition['keyword']) && !empty($condition['keyword'])){
                    $query->where('name','like','%'.$condition['keyword'].'%');
                };
            });
            if(!empty($join)){
                $query -> join(...$join);
            }    
            return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);   
        }
    
}
