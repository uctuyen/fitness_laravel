<?php

namespace App\Services;

use App\Services\Interfaces\TrainerServiceInterface;
use App\Repositories\Interfaces\TrainerRepositoriesInterface as TrainerRepositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
/**
 * Class TrainerService
 * @package App\Services
 */
class TrainerService implements TrainerServiceInterface
{
    protected $trainerRepositories;
    public function __construct(
        TrainerRepositories $trainerRepositories
    ){
        $this->trainerRepositories = $trainerRepositories;
    }
    public function getAllPaginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['gender'] = (int)$request->input('gender');


        $perPage = (int)$request->input('perpage');
        $trainers = $this->trainerRepositories->paginate
            ($this->paginateSelect(),
            $condition,
            [],
            ['path'=>'/trainer/index'],$perPage);
        return $trainers;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send','re_password');
            $payload['day_of_birth']  = $this->convertDate($payload['day_of_birth']);
            $payload['password'] = Hash::make($payload['password']);
            $trainer = $this->trainerRepositories->create($payload);

            if($trainer->id > 0){
                $majors = $request->only('major_id');
                $trainer->majors()->sync($majors['major_id']);
            }


            DB::commit();
            return [
                'trainer' => $trainer,
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
            $trainer = $this->trainerRepositories->update($id, $payload);
            $majors = $request->only('major_id');
            $trainer->majors()->detach();
            $trainer->majors()->sync($majors['major_id']);
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
        $trainer = $this->trainerRepositories->findById($id);
        if(!$trainer) {
            return false;
        }
        $majorIds = $trainer->majors()->pluck('majors.id');
        DB::table('trainer_majors')->where('trainer_id', $id)->whereIn('major_id', $majorIds)->delete();
        $trainer->majors()->detach();
        $this->trainerRepositories->delete($id);
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
