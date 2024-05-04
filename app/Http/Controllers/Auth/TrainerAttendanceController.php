<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AttendanceService;
use App\Repositories\Interfaces\AttendanceRepositoriesInterface as AttendanceRepositories;
use App\Models\classModel;
use App\Models\Trainer;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

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
        $loggedInTrainer = Auth::user();
        $attendances = $this->attendanceService->getAllPaginate( $request, $loggedInTrainer->id);
        $config['seo'] = config('apps.attendance');
        $template = 'backendTrainer.Attendance.index';
        // Chỉ lấy các lớp mà trainer đang dạy
        $classes = $loggedInTrainer->classes;
        $trainers = Trainer::all();
        return view('backendTrainer.dashboard.layout',compact(
            'template',
            'config',
            'attendances',
            'classes',
            'trainers',
        ));
    }
    public function create(){
        $loggedInTrainer = Auth::user();
        $classes = $loggedInTrainer->classes;
        $trainers = Trainer::all();
        $config['seo'] = config('apps.attendance');
        $config['method'] = 'create';
        $template = 'backendTrainer.attendance.save';
        return view('backendTrainer.dashboard.layout',compact(
            'template',
            'config',
            'classes',
            'loggedInTrainer',
            'trainers', 
        ));
    }
    public function save(SaveAttendanceRequest $request){
        if($this->attendanceService->create($request)){
         return redirect()->route('attendance.index')->with('success', 'Thêm mới lớp học thành công!');
        };
        return redirect()->route('attendance.index')->with('error', 'Thêm mới lớp học không thành công!');
     } 

   
}