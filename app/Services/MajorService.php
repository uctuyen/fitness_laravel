<?php

namespace App\Services;

use App\Services\Interfaces\MajorServiceInterface;
use App\Repositories\Interfaces\MajorRepositoriesInterface as MajorRepositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
/**
 * Class MajorService
 * @package App\Services
 */
class MajorService implements MajorServiceInterface
{
    protected $majorRepositories;
    public function __construct(
        MajorRepositories $majorRepositories
    ){
        $this->majorRepositories = $majorRepositories;
    }
    public function getAllPaginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['gender'] = (int)$request->input('gender');


        $perPage = (int)$request->input('perpage');
        $majors = $this->majorRepositories->paginate
            ($this->paginateSelect(),
            $condition,
            [],
            ['path'=>'employee/index'],$perPage);
        return $majors;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send','re_password');
            $payload['day_of_birth']  = $this->convertDate($payload['day_of_birth']);
            $payload['password'] = Hash::make($payload['password']);
            $major = $this->majorRepositories->create($payload);
            DB::commit();
            return [
                'employee' => $major,
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
            $major = $this->majorRepositories->update($id, $payload);
            DB::commit();
            // return [
            //     'employee' => $major,
            // ];
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
            $major = $this->majorRepositories->delete($id);
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
            'first_name',
            'last_name',
            'gender',
            'phone_number',
            'last_name',
            'email',
            'day_of_birth',
            'address'
        ];
    }
}
