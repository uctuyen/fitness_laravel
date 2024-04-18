<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Services\ClassSessionService;
use App\Repositories\Interfaces\ClassSessionRepositoriesInterface as ClassSessionRepositories;
use App\Http\Requests\SaveClassSessionRequest;
use App\Http\Requests\UpdateClassSessionRequest;
class ClassSessionController extends Controller
{
    protected $classSessionService;
    protected $classSessionRepositories;
    public function __construct(
        ClassSessionService $classSessionService,
        ClassSessionRepositories $classSessionRepositories,
    ){
        $this->classSessionService = $classSessionService; 
        $this->classSessionRepositories = $classSessionRepositories; 
    }
    public function index(Request $request){
        $classSessions = $this->classSessionService->getAllPaginate($request);
        $config['seo'] = config('apps.class');
        $template = 'backend.classSession.index';
        return view('backend.dashboard.layout',compact(
            'classSessions',
            'template',
            'config',
        ));
        
    }

    public function create(){
        $config['seo'] = config('apps.classSession');
        $config['method'] = 'create';
        $template = 'backend.classSession.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
        ));
    }
    public function save(SaveClassSessionRequest $request){
        if($this->classSessionService->create($request)){
         return redirect()->route('classSession.index')->with('success', 'Thêm mới lớp học thành công!');
        };
        return redirect()->route('classSession.index')->with('error', 'Thêm mới lớp học không thành công!');
     }
    public function edit($id){
        $classSession = $this->classSessionRepositories->findById($id);
        $config['seo'] = config('apps.classSession');
        $config['method'] = 'edit';
        $template = 'backend.classSession.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'classSession',
        ));
    }
    
    public function update($id, UpdateClassSessionRequest $request){
        if($this->classSessionService->update($id, $request)){
            return redirect()->route('class.index')->with('success', 'Cập nhật lớp học thành công!');
        };
        return redirect()->route('class.index')->with('error', 'Cập nhật lớp học không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.classSession');
        $classSession = $this->classSessionRepositories->findById($id);
        $template = 'backend.classSession.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'classSession',
        ));
    }
    public function destroy($id){
        if($this->classSessionService->destroy($id)){
            return redirect()->route('classSession.index')->with('success', 'Xóa lớp học thành công!');
           };
           return redirect()->route('classSession.index')->with('error', 'Xóa lớp học không thành công!');
    }
    public function calendar()
    {
        $config['seo'] = config('apps.classSession');
        $template = 'backend.classSession.calendar'; // Đường dẫn đến file view calendar của bạn
    
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }
        public function getEvents()
        {
        $classSessions = $this->classSessionRepositories->getAll(); // Lấy tất cả các phiên học

        $events = [];
        foreach ($classSessions as $session) {
            $events[] = [
                'title' => $session->name, 
                'start' => $session->start_date->format('c'), // Chuyển đổi định dạng ngày giờ
                'end' => $session->end_date->format('c'), // Chuyển đổi định dạng ngày giờ
            ];
        }
        return response()->json($events);
        }
}