<?php

namespace App\Services;

use App\Services\Interfaces\TrainerAttendanceServiceInterface;

/**
 * Class TrainerAttendanceService
 * @package App\Services
 */
class TrainerAttendanceService implements TrainerAttendanceServiceInterface
{
    protected $attendanceRepositories;
    public function __construct(
        TrainerAttendanceRepositories $trainerAttendanceRepositories
    ){
        $this->trainerAttendanceRepositories = $trainerAttendanceRepositories;
    }
    public function getAllPaginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $trainerAttendances = $this->trainerAttendanceRepositories->paginate
            ($this->paginateSelect(),
            $condition,
            [],
            ['path'=>'/trainerAttendance/index']
        );
        return $trainerAttendances;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send');
            $trainerAttendance = $this->trainerAttendanceRepositories->create($payload);
            DB::commit();
            return [
                'trainerAttendance' => $trainerAttendance,
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
            $trainerAttendance = $this->trainerAttendanceRepositories->update($id, $payload);
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
            $trainerAttendance = $this->trainerAttendanceRepositories->delete($id);
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
            'member_id',
            'class_id',
            'date_trainerAttendance',
            'time'
        ];
    }
}
