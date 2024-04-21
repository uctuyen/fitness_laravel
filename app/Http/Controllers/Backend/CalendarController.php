<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Services\CalendarService;
use App\Repositories\Interfaces\CalendarRepositoriesInterface as CalendarRepositories;
use App\Http\Requests\SaveCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Models\classModel;
use App\Models\Trainer;

class CalendarController extends Controller
{
    protected $calendarService;
    protected $calendarRepositories;
    public function __construct(
        CalendarService $calendarService,
        CalendarRepositories $calendarRepositories,
    ){
        $this->calendarService = $calendarService; 
        $this->calendarRepositories = $calendarRepositories; 
    }
    public function index(Request $request){
        $trainers = Trainer::all();
        $classes = classModel::all();
        // Lấy dữ liệu theo tuần
        $week = $request->get('week', date('W')); // Lấy tuần từ request hoặc mặc định là tuần hiện tại
        $calendars = $this->calendarService->getAllPaginate($request);
        // $calendars->load('class'); // casi cu cai gi day the +_+
        // dd($calendars);

        $config['seo'] = config('apps.calendar');
        $template = 'backend.calendar.index';
        return view('backend.dashboard.layout',compact(
            'calendars',
            'template',
            'config',
            'week',
            'classes',
            'trainers'
            
        ));
    }
    public function calendar (){
        $config['seo'] = config('apps.calendar');
        $template = 'backend.calendar.calendar';
        $events = [];
        $classes = classModel::all();
        $trainers = Trainer::all();
        $calendar = Calendar::all();
        foreach ($calendar as $item) {
            $class_id = $item->class_id;
            $events[] = [
                'title' => $item->class->name . ' - ' . $item->class->trainer->first_name . ' ' . $item->class->trainer->last_name,
                'start' => $item->start_date,
                'end' => $item->end_date,
            ];
        }
        return view('backend.dashboard.layout',['events'=>$events],compact(
            'template',
            'events',
            'config',
            'classes',
            'trainers',
            'calendar'
        ));
    }
    public function create(){
        $trainers = Trainer::all();
        $classes = classModel::all();
        $config['seo'] = config('apps.calendar');
        $config['method'] = 'create';
        $template = 'backend.calendar.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'trainers',
            'classes'
        ));
    }
    // public function getEvents()
    // {   
    //     $events = [];
    //     $calendars = Calendar::all(); // Lấy tất cả sự kiện từ bảng calendars

    //     foreach ($calendars as $calendar) {
    //         $events[] = [
    //         'start' => $calendar->day,
    //         'end' => $calendar->time,
    //         'className' => $calendar->class->name, // Lấy tên lớp từ bảng Class
    //         'trainerName' => $calendar->class->trainer->name, // Lấy tên trainer từ bảng Trainer
    //         ];
    //     }
    //     return response()->json($events); // Trả về dữ liệu dưới dạng JSON
    // }
    public function save(SaveCalendarRequest $request){
        if($this->calendarService->create($request)){
         return redirect()->route('calendar.index')->with('success', 'Thêm mới lịch tập thành công!');
        };
        return redirect()->route('calendar.index')->with('error', 'Thêm mới lịch tập không thành công!');
     }
    public function edit($id){
        $calendar = $this->calendarRepositories->findById($id);
        $config['seo'] = config('apps.calendar');
        $config['method'] = 'edit';
        $template = 'backend.calendar.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'calendar',
            'trainers',
            'majors'
        ));
    }
    
    public function update($id, UpdateCalendarRequest $request){
        if($this->calendarService->update($id, $request)){
            return redirect()->route('calendar.index')->with('success', 'Cập nhật lịch tập thành công!');
        };
        return redirect()->route('calendar.index')->with('error', 'Cập nhật lịch tập không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.calendar');
        $calendar = $this->calendarRepositories->findById($id);
        $template = 'backend.calendar.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'calendar',
        ));
    }
    public function destroy($id){
        if($this->calendarService->destroy($id)){
            return redirect()->route('calendar.index')->with('success', 'Xóa lịch tập thành công!');
           };
           return redirect()->route('calendar.index')->with('error', 'Xóa lịch tập không thành công!');
    }

}