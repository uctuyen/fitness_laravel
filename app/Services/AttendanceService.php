<?php

namespace App\Services;

use App\Repositories\Interfaces\AttendanceRepositoriesInterface as AttendanceRepositories;
use App\Services\Interfaces\AttendanceServiceInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class AttendanceService
 */
class AttendanceService implements AttendanceServiceInterface
{
    protected $attendanceRepositories;

    public function __construct(
        AttendanceRepositories $attendanceRepositories
    ) {
        $this->attendanceRepositories = $attendanceRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = (int) $request->input('perpage');
        $attendances = $this->attendanceRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/attendance/index', $perPage]
        );

        return $attendances;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $attendance = $this->attendanceRepositories->create($payload);
            DB::commit();

            return [
                'attendance' => $attendance,
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
            $attendance = $this->attendanceRepositories->update($id, $payload);
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
            $attendance = $this->attendanceRepositories->delete($id);
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
            'member_id',
            'calendar_id',
            'status',
        ];
    }
}
