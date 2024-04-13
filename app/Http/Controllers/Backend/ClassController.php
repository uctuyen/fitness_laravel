<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Class;
use App\Services\ClassService;
use App\Repositories\Interfaces\ClassRepositoriesInterface as ClassRepositories;
use App\Http\Requests\SaveClassRequest;
use App\Http\Requests\UpdateClassRequest;
class ClassController extends Controller
{
    protected $classService;
    protected $classRepositories;
    public function __construct(
        ClassService $classService,
        ClassRepositories $classRepositories,
    ){
        $this->classService = $classService; 
        $this->classRepositories = $classRepositories; 
    }
    public function index(Request $request){
        $classes = $this->classService->getAllPaginate($request);
        $config['seo'] = config('apps.class');
        $template = 'backend.class.index';
        return view('backend.dashboard.layout',compact(
            'classes',
            'template',
            'config',
        ));
        
    }

    public function create(){
        
        $config['seo'] = config('apps.class');
        $config['method'] = 'create';
        $template = 'backend.class.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
        ));
    }
    public function save(SaveClassRequest $request){
        if($this->classService->create($request)){
         return redirect()->route('class.index')->with('success', 'Thêm mới chuyên môn thành công!');
        };
        return redirect()->route('class.index')->with('error', 'Thêm mới chuyên môn không thành công!');
     }
    public function edit($id){
        $class = $this->classRepositories->findById($id);
        $config['seo'] = config('apps.class');
        $config['method'] = 'edit';
        $template = 'backend.class.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'class',
        ));
    }
    
    public function update($id, UpdateClassRequest $request){
        if($this->classService->update($id, $request)){
            return redirect()->route('class.index')->with('success', 'Cập nhật chuyên môn thành công!');
        };
        return redirect()->route('class.index')->with('error', 'Cập nhật chuyên môn không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.class');
        $class = $this->classRepositories->findById($id);
        $template = 'backend.class.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'class',
        ));
    }
    public function destroy($id){
        if($this->classService->destroy($id)){
            return redirect()->route('class.index')->with('success', 'Xóa chuyên môn thành công!');
           };
           return redirect()->route('class.index')->with('error', 'Xóa chuyên môn không thành công!');
    }

}