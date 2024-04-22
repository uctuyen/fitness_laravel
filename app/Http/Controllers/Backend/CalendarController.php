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
    public function index (){
        $config['seo'] = config('apps.calendar');
        $template = 'backend.calendar.index';
        $events = [];
        $classes = classModel::all();
        $trainers = Trainer::all();
        $calendar = Calendar::all();
        foreach ($calendar as $item) {
            $class_id = $item->class_id;
            $events[] = [
                'id' => $item->id,
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
    public function save(Request $request){
        $request->validate([
            'class_id' => 'required',
            'trainer_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
    
        $class = classModel::find($request->class_id);
        if ($class === null) {
            return response()->json(['error' => 'Class not found'], 404);
        }
        $trainer = $class->trainer;
        $trainer = Trainer::find($request->trainer_id);
        if ($trainer === null) {
            return response()->json(['error' => 'Trainer not found'], 404);
        }
        $calendar = Calendar::create([
            'class_id' => $request->class_id,
            'trainer_id' => $request->trainer_id,
            'title' => $class->name . ' - ' . $trainer->first_name . ' ' . $trainer->last_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        return response()->json($calendar);
    }
    public function update(Request $request,$id){
        $calendar = Calendar::find($id);
        if ($calendar === null) {
            return response()->json(['error' => 'Calendar not found'], 
            404);
        }
        $calendar->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');    }
}