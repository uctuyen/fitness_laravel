<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Services\AttendanceService;
use App\Repositories\Interfaces\AttendanceRepositoriesInterface as AttendanceRepositories;
use App\Models\classModel;
use App\Models\Trainer;
class AttendanceController extends Controller
{
    protected $AttendanceService;
    protected $AttendanceRepositories;
    public function __construct(
        AttendanceService $AttendanceService,
        AttendanceRepositories $AttendanceRepositories,
    ){
        $this->AttendanceService = $AttendanceService; 
        $this->AttendanceRepositories = $AttendanceRepositories; 
    }
    public function index (){
        $config['seo'] = config('apps.Attendance');
        $template = 'backend.Attendance.index';
        $events = [];
        $classes = classModel::all();
        $trainers = Trainer::all();
        $calendar = Calendar::all();
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'classes',
            'trainers',
            'calendar'
        ));
    }
    public function create(){
        $trainers = Trainer::all();
        $majors = Major::all();
        $config['seo'] = config('apps.attendance');
        $config['method'] = 'create';
        $template = 'backend.attendance.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'trainers',
            'majors'
        ));
    }
    public function save(SaveAttendanceRequest $request){
        if($this->attendanceService->create($request)){
         return redirect()->route('attendance.index')->with('success', 'Thêm mới lớp học thành công!');
        };
        return redirect()->route('attendance.index')->with('error', 'Thêm mới lớp học không thành công!');
     }
    public function edit($id){
        $attendance = $this->attendanceRepositories->findById($id);
        $trainers = Trainer::all();
        $majors = Major::all();
        $config['seo'] = config('apps.attendance');
        $config['method'] = 'edit';
        $template = 'backend.attendance.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'attendance',
            'trainers',
            'majors'
        ));
    }
    
    public function update($id, UpdateAttendanceRequest $request){
        if($this->attendanceService->update($id, $request)){
            return redirect()->route('attendance.index')->with('success', 'Cập nhật lớp học thành công!');
        };
        return redirect()->route('attendance.index')->with('error', 'Cập nhật lớp học không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.attendance');
        $attendance = $this->attendanceRepositories->findById($id);
        $template = 'backend.attendance.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'attendance',
        ));
    }
    public function destroy($id){
        if($this->attendanceService->destroy($id)){
            return redirect()->route('attendance.index')->with('success', 'Xóa lớp học thành công!');
           };
           return redirect()->route('attendance.index')->with('error', 'Xóa lớp học không thành công!');
    }
}