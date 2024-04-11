<?php

namespace App\Repositories;

use App\Models\Base;
use App\Repositories\Interfaces\BaseRepositoriesInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;


class BaseRepositories implements BaseRepositoriesInterface{
    protected $model;
    public function __construct(
        Model $model
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
                                            $query->where('first_name','like','%'.$condition['keyword'].'%')
                                                ->orWhere('last_name','like','%'.$condition['keyword'].'%')
                                                ->orWhere('email','like','%'.$condition['keyword'].'%')
                                                ->orWhere('address','like','%'.$condition['keyword'].'%')
                                                ->orWhere('phone_number','like','%'.$condition['keyword'].'%');
                                        };
                                        if(isset($condition['gender']) && in_array($condition['gender'], [0, 1, 2])){
                                            $query->where('gender', $condition['gender']);
                                        }
                                    });
            if(!empty($join)){
                $query -> join(...$join);
            }    
            return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);    
        }
    public function create(array $payload =[]){
        $model = $this->model->create($payload);
        return $model->fresh();
    }
    public function update(int $id = 0,  array $payload =[]){
        $model = $this->findById($id);
        return $model->update($payload);
    }
    public function delete(int $id = 0){
        return $this->findById($id)->delete();
    }
    public function all(){
        return $this->model->all();
    }
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $Relation = []
        ){
            return $this->model->select($column)->with($Relation)->findOrFail($modelId);
}
}