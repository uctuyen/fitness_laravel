<?php

namespace App\Services;

use App\Services\Interfaces\ClassServiceInterface;
use App\Repositories\Interfaces\ClassRepositoriesInterface as ClassRepositories;
use Illuminate\Support\Facades\DB;
/**
 * Class ClassService
 * @package App\Services
 */
class ClassService implements ClassServiceInterface
{
    protected $classRepositories;
    public function __construct(
        ClassRepositories $classRepositories
    ){
        $this->classRepositories = $classRepositories;
    }
    public function getAllPaginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $classs = $this->classRepositories->paginate
            ($this->paginateSelect(),
            $condition,
            [],
            ['path'=>'/class/index']
        );
        return $classs;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send');
            $class = $this->classRepositories->create($payload);
            DB::commit();
            return [
                'class' => $class,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    
    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send');
            $class = $this->classRepositories->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try {
            $class = $this->classRepositories->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    
    public function paginateSelect(){
        return [
            'id',
            'name',
            'price',
            'quantity_member',
        ];
    }
}