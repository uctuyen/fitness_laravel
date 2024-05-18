<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Services\AttendanceService;
use App\Repositories\Interfaces\AttendanceRepositoriesInterface as AttendanceRepositories;
use App\Models\classModel;
use App\Models\Trainer;
use App\Models\Attendance;
use App\Models\Calendar;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainerAttendanceController extends Controller
{
    protected $attendanceService;
    protected $attendanceRepositories;

    public function __construct(
        AttendanceService $attendanceService,
        AttendanceRepositories $attendanceRepositories,
    ){
        $this->attendanceService = $attendanceService;
        $this->attendanceRepositories = $attendanceRepositories;
    }

    public function index (Request $request){
        $classes = Attendance::whereHas('calendar.class', function (Builder $query) {
            $query->where('trainer_id', Auth::id());
        })->groupBy('calendar_id')->paginate(10);
        $config['seo'] = config('apps.attendance');
        $template = 'backendTrainer.Attendance.index';
        $trainers = Trainer::all();
        return view('backendTrainer.dashboard.layout',compact(
            'template',
            'config',
            'classes',
            'trainers',
        ));
    }
    public function checkIn(Calendar $calendar) {
        $config['seo'] = config('apps.attendance');
        $config['method'] = 'check-in';
        $template = 'backendTrainer.attendance.check-in';

        $attendances = $calendar->attendances;
        return view('backendTrainer.dashboard.layout', compact(
            'template',
            'config',
            'attendances',
            'calendar',
        ));
    }

    public function postCheckIn(Request $request, $calendar_id) {
        try {
            DB::beginTransaction();

            Attendance::where('calendar_id', $calendar_id)->update(['status' => 0]);
            if (!empty($request->attendance_id)) {
                foreach ($request->attendance_id as $attendance_id => $value) {
                    Attendance::find($attendance_id)->update(['status' => 1]);
                }
            }

            DB::commit();

            return redirect()->route('trainer.attendance')->with('success', 'Điểm danh thành công!');
        } catch (Exception) {
            DB::rollback();

            return redirect()->back()->with('error', 'Điểm danh không thành công!');
        }
    }
}
