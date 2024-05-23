<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Calendar;
use App\Models\classModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardMemberController extends Controller
{
    public function __construct()
    {

    }

    public function dashboardMember(Request $request)
    {
        $calendarIds = Attendance::where('member_id', Auth::guard('member')->id())
            ->groupBy('calendar_id')
            ->pluck('calendar_id');

        $classIds = Calendar::whereIn('id', $calendarIds)
            ->groupBy('class_id')
            ->pluck('class_id');

        $classes = classModel::whereIn('id', $classIds)->get();

        $calendars = [];
        if (! empty($request->class_id)) {
            $now = Carbon::now();
            $startDate = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d H:i:s');
            $endDate = $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d H:i:s');
            $calendars = Calendar::with('class.trainer')
                ->where('class_id', $request->class_id)
                ->whereBetween('start_date', [$startDate, $endDate])
                ->orderBy('start_date', 'desc')
                ->get();
        }

        $config = $this->config();
        $template = 'backendMember.dashboard.home.index';

        return view('backendMember.dashboard.layout', compact(
            'template',
            'config',
            'classes',
            'calendars',
        ));
    }
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        if ($attendance) {
            $attendance->delete();
            return redirect()->route('attendance.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('attendance.index')->with('error', 'Xóa không thành công!');
    }
    private function config()
    {
        return [
            'js' => [
                asset('/backend/js/plugins/flot/jquery.flot.js'),
                asset('/backend/js/plugins/flot/jquery.flot.tooltip.min.js'),
                asset('/backend/js/plugins/flot/jquery.flot.spline.js'),
                asset('/backend/js/plugins/flot/jquery.flot.resize.js'),
                asset('/backend/js/plugins/flot/jquery.flot.pie.js'),
                asset('/backend/js/plugins/flot/jquery.flot.symbol.js'),
                asset('/backend/js/plugins/flot/jquery.flot.time.js'),
                asset('/backend/js/plugins/peity/jquery.peity.min.js'),
                asset('/backend/js/demo/peity-demo.js'),
                asset('/backend/js/inspinia.js'),
                asset('/backend/js/plugins/pace/pace.min.js'),
                asset('/backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js'),
                asset('/backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
                asset('/backend/js/plugins/easypiechart/jquery.easypiechart.js'),
                asset('/backend/js/plugins/sparkline/jquery.sparkline.min.js'),
                asset('/backend/js/demo/sparkline-demo.js'),
            ],
        ];
    }
}
