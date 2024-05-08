<?php

namespace App\Services;

use App\Services\Interfaces\EmployeeServiceInterface;
use App\Repositories\Interfaces\EmployeeRepositoriesInterface as EmployeeRepositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
/**
 * Class EmployeeService
 * @package App\Services
 */
class EmployeeService implements EmployeeServiceInterface
{
    protected $employeeRepositories;
    public function __construct(
        EmployeeRepositories $employeeRepositories
    ){
        $this->employeeRepositories = $employeeRepositories;
    }
    public function getAllPaginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['gender'] = (int)$request->input('gender');
        $perPage = (int)$request->input('perpage');
        $employees = $this->employeeRepositories->paginate
            ($this->paginateSelect(),
            $condition,
            [],
            ['path'=>'/employee/index'],$perPage);
        return $employees;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send','re_password');
            $payload['day_of_birth']  = $this->convertDate($payload['day_of_birth']);
            $payload['password'] = Hash::make($payload['password']);
            $employee = $this->employeeRepositories->create($payload);
            DB::commit();
            return [
                'employee' => $employee,
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
            $payload['day_of_birth'] = $this->convertDate($payload['day_of_birth']);
            // Tiếp tục thêm dữ liệu vào cơ sở dữ liệu
            $employee = $this->employeeRepositories->update($id, $payload);
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
            $employee = $this->employeeRepositories->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function convertDate($day_of_birth){
        $carbonDate = Carbon::createFromFormat('Y-m-d', $day_of_birth);
        $day_of_birth = $carbonDate->format('Y-m-d H:i:s');
        return $day_of_birth;
    }
    public function paginateSelect(){
        return [
            'id',
            'avatar',
            'first_name',
            'last_name',
            'gender',
            'phone_number',
            'email',
            'day_of_birth',
            'address'
        ];
    }
}