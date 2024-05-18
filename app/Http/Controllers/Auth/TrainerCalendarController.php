<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\classModel;
use App\Models\Trainer;
use App\Repositories\Interfaces\CalendarRepositoriesInterface as CalendarRepositories;
use App\Services\CalendarService;

class TrainerCalendarController extends Controller
{
    protected $calendarService;

    protected $calendarRepositories;

    public function __construct(
        CalendarService $calendarService,
        CalendarRepositories $calendarRepositories,
    ) {
        $this->calendarService = $calendarService;
        $this->calendarRepositories = $calendarRepositories;
    }

    public function index()
    {
        $config['seo'] = config('apps.calendar');
        $template = 'backend.calendar.index';
        $events = [];
        $classes = classModel::all();
        $trainers = Trainer::all();
        $calendar = Calendar::all();
        $color = [
            '#66ffff',
            '#009900',
            '#ff99ff',
            '#0000ff',
            '#ff1a1a',
            '#66ffcc',
            '#ff99ff',
        ];
        $classColors = [];
        foreach ($classes as $class) {
            $classColors[$class->id] = $color[$class->id % count($color)];
        }
        foreach ($calendar as $item) {
            $class_id = $item->class_id;
            $events[] = [
                'id' => $item->id,
                'title' => $item->class->name.' - '.$item->class->trainer->first_name.' '.$item->class->trainer->last_name,
                'start' => $item->start_date,
                'end' => $item->end_date,
                'color' => $classColors[$class_id],
            ];
        }

        return view('backendTrainer.dashboard.layout', ['events' => $events], compact(
            'template',
            'events',
            'config',
            'classes',
            'trainers',
            'calendar'
        ));
    }
}
