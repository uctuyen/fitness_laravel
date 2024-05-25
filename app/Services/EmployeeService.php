<?php

namespace App\Services;

use App\Repositories\Interfaces\EmployeeRepositoriesInterface as EmployeeRepositories;
use App\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class EmployeeService
 */
class EmployeeService implements EmployeeServiceInterface
{
    protected $employeeRepositories;

    public function __construct(
        EmployeeRepositories $employeeRepositories
    ) {
        $this->employeeRepositories = $employeeRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['gender'] = (int) $request->input('gender');
        $perPage = (int) $request->input('perpage');
        $employees = $this->employeeRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/employee/index'], $perPage);

        return $employees;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send', 're_password');
            $payload['day_of_birth'] = $this->convertDate($payload['day_of_birth']);
            $payload['password'] = Hash::make($payload['password']);
            $employee = $this->employeeRepositories->create($payload);
            DB::commit();

            return [
                'employee' => $employee,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            exit();

            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            // Tiếp tục thêm dữ liệu vào cơ sở dữ liệu
            $employee = $this->employeeRepositories->update($id, $payload);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            exit();

            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepositories->delete($id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            exit();

            return false;
        }
    }

    public function paginateSelect()
    {
        return [
            'id',
            'avatar',
            'first_name',
            'last_name',
            'gender',
            'phone_number',
            'email',
            'day_of_birth',
            'address',
        ];
    }
}
