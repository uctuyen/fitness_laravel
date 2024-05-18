<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Calendar;
use App\Models\Trainer;
use App\Repositories\Interfaces\AttendanceRepositoriesInterface as AttendanceRepositories;
use App\Services\AttendanceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    protected $attendanceService;

    protected $attendanceRepositories;

    public function __construct(
        AttendanceService $attendanceService,
        AttendanceRepositories $attendanceRepositories,
    ) {
        $this->attendanceService = $attendanceService;
        $this->attendanceRepositories = $attendanceRepositories;
    }

    public function index(Request $request)
    {
        $config['seo'] = config('apps.attendance');
        $template = 'backend.Attendance.index';
        $classes = Attendance::groupBy('calendar_id')->paginate(10);
        $trainers = Trainer::all();

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'classes',
            'trainers',
        ));
    }

    public function checkIn(Calendar $calendar)
    {
        $config['seo'] = config('apps.attendance');
        $config['method'] = 'check-in';
        $template = 'backend.attendance.check-in';

        $attendances = $calendar->attendances;

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'attendances',
            'calendar',
        ));
    }

    public function postCheckIn(Request $request, $calendar_id)
    {
        try {
            DB::beginTransaction();

            Attendance::where('calendar_id', $calendar_id)->update(['status' => 0]);
            if (! empty($request->attendance_id)) {
                foreach ($request->attendance_id as $attendance_id => $value) {
                    Attendance::find($attendance_id)->update(['status' => 1]);
                }
            }

            DB::commit();

            return redirect()->route('attendance.index')->with('success', 'Điểm danh thành công!');
        } catch (Exception) {
            DB::rollback();

            return redirect()->back()->with('error', 'Điểm danh không thành công!');
        }
    }
}
