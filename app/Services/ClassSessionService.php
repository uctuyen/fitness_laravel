<?php

namespace App\Services;

use App\Services\Interfaces\ClassSessionServiceInterface;
use App\Repositories\Interfaces\ClassSessionRepositoriesInterface as ClassSessionRepositories;
use Illuminate\Support\Facades\DB;
/**
 * ClassSession ClassSessionSessionService
 * @package App\Services
 */
class ClassSessionService implements ClassSessionServiceInterface
{
    protected $classSessionRepositories;
    public function __construct(
        ClassSessionRepositories $classSessionRepositories
    ){
        $this->classSessionRepositories = $classSessionRepositories;
    }
    public function getAllPaginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $classSessions = $this->classSessionRepositories->paginate
            ($this->paginateSelect(),
            $condition,
            [],
            ['path'=>'/classSession/index']
        );
        return $classSessions;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send');
            $classSession = $this->classSessionRepositories->create($payload);
            DB::commit();
            return [
                'classSession' => $classSession,
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
            $classSession = $this->classSessionRepositories->update($id, $payload);
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
            $classSession = $this->classSessionRepositories->delete($id);
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
            'day_of_week',
            'start_time',
            'end_time',
        ];
    }
}
