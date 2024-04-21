<?php

namespace App\Services;

use App\Services\Interfaces\CalendarServiceInterface;
use App\Repositories\Interfaces\CalendarRepositoriesInterface as CalendarRepositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
/**
 * Calendare calendarService
 * @package App\Services
 */
class CalendarService implements CalendarServiceInterface
{
    protected $classRepositories;
    public function __construct(
        CalendarRepositories $calendarRepositories
    ){
        $this->calendarRepositories = $calendarRepositories;
    }
    public function getAllPaginate($request, $dateRange = []){
        $condition['keyword'] = addslashes($request->input('keyword'));
        if (!empty($dateRange['start_date']) && !empty($dateRange['end_date'])) {
            $condition['start_date'] = $dateRange['start_date'];
            $condition['end_date'] = $dateRange['end_date'];
        }
        $calendars = $this->calendarRepositories->paginate
            ($this->paginateSelect(),
            $condition,
            [],
            ['path'=>'/calendar/index']
        );


        return $calendars;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send');
            $payload['day']  = $this->convertDate($payload['day']);
            $calendar = $this->calendarRepositories->create($payload);
            DB::commit();
            return [
                'calendar' => $calendar,
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
            $payload['day']  = $this->convertDate($payload['day']);
            $calendar = $this->calendarRepositories->update($id, $payload);
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
            $calendar = $this->calendarRepositories->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function convertDate($day){
        $carbonDate = Carbon::createFromFormat('Y-m-d', $day);
        $day = $carbonDate->format('Y-m-d H:i:s');
        return $day;
    }
    public function paginateSelect(){
        return [
            'id',
            'class_id',
            'start_date',
            'end_date',
        ];
    }
}