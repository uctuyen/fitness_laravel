<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Repositories\Interfaces\AttendanceRepositoriesInterface;

/**
 * Class AttendanceService
 */
class AttendanceRepositories extends BaseRepositories implements AttendanceRepositoriesInterface
{
    protected $model;

    public function __construct(
        Attendance $model
    ) {
        $this->model = $model;
    }

    public function paginate(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perPage = 20,
    ) {
        $query = $this->model->select('attendances.id', 'calendars.*', 'classes.*', 'trainers.*')
        ->join('calendars', 'attendances.calendar_id', '=', 'calendars.id')
        ->join('classes', 'calendars.class_id', '=', 'classes.id')
        ->join('trainers', 'classes.trainer_id', '=', 'trainers.id')
        ->where(function ($query) use ($condition) {
            if (isset($condition['keyword']) && ! empty($condition['keyword'])) {
                $query->where('trainers.first_name', 'like', '%'.$condition['keyword'].'%')
                ->orWhere('trainers.last_name', 'like', '%'.$condition['keyword'].'%');
            }
        });
        if (! empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
}
