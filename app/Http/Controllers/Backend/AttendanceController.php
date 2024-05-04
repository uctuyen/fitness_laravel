<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AttendanceService;
use App\Repositories\Interfaces\AttendanceRepositoriesInterface as AttendanceRepositories;
use App\Models\classModel;
use App\Models\Trainer;
use App\Models\Attendance;
class AttendanceController extends Controller
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
        $attendances = $this->attendanceService->getAllPaginate($request);
        $config['seo'] = config('apps.attendance');
        $template = 'backend.Attendance.index';
        $classes = classModel::all();
        $trainers = Trainer::all();
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'attendances',
            'classes',
            'trainers',
        ));
    }
    public function create(){
        $classes = classModel::all();
        $trainers = Trainer::all();
        $config['seo'] = config('apps.attendance');
        $config['method'] = 'create';
        $template = 'backend.attendance.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'classes',
            'trainers',
        ));
    }
    public function save(SaveAttendanceRequest $request){
        if($this->attendanceService->create($request)){
         return redirect()->route('attendance.index')->with('success', 'Thêm mới lớp học thành công!');
        };
        return redirect()->route('attendance.index')->with('error', 'Thêm mới lớp học không thành công!');
     }
    public function edit($id){
        $attendances = $this->attendanceRepositories->findById($id);
        $classes = classModel::all();
        $trainers = Trainer::all();
        $config['seo'] = config('apps.attendance');
        $config['method'] = 'edit';
        $template = 'backend.attendance.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'attendances',
            'classes',
            'trainers',
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