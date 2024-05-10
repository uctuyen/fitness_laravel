<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Attendance;
use App\Models\Calendar;
use App\Models\classModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::with('calendar.class.trainer')->where('member_id', Auth::guard('member')->id())->paginate(20);

        $data = [
            'attendances' => $attendances
        ];

        return view('backendMember.attendance.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = classModel::all();

        $data = [
            'classes' => $classes,
        ];

        return view('backendMember.attendance.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        try {
            DB::beginTransaction();
            
            Attendance::create([
                'member_id' => Auth::guard('member')->id(),
                'calendar_id' => $request->calendar_id,
            ]);

            DB::commit();

            return redirect()->route('attendances.index')->with('success', 'Đăng ký lịch học thành công!');
        } catch (Exception) {
            DB::rollback();

            return redirect()->back()->with('error', 'Đăng ký lịch học không thành công!');
        }
    }

    public function getCalendarList(Request $request)
    {
        $calendarIds = Attendance::where('member_id', Auth::guard('member')->id())->pluck('id');

        $data = Calendar::where('class_id', $request->class_id)
            ->whereDate('start_date', '>', Carbon::now()->endOfDay())
            ->whereNotIn('id', $calendarIds)
            ->get();

        return response()->json(['data' => $data]);
    }
}
