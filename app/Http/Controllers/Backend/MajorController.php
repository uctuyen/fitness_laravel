<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Services\MajorService;
use App\Repositories\Interfaces\MajorRepositoriesInterface as MajorRepositories;
class MajorController extends Controller
{
    public function __construct(
        MajorService $majorService,
        MajorRepositories $majorRepositories,
    ){
        $this->majorService = $majorService; 
        $this->majorRepositories = $majorRepositories; 
    }
    public function index(Request $request){
        $major = $this->majorService->getAllPaginate($request);
        $config['seo'] = config('apps.major');
        $template = 'backend.major.index';
        
        return view('backend.dashboard.layout',compact(
            'major',
            'template',
            'config',
        ));
        
    }

    public function create(){
        
        $major = new Major;
        $config['seo'] = config('apps.major');
        $config['method'] = 'create';
        $template = 'backend.major.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'major',
        ));
    }
    public function save(SaveMajorRequest $request){
       if($this->majorervice->create($request)){
        return redirect()->route('major.index')->with('success', 'Thêm mới nhân viên thành công!');
       };
       return redirect()->route('major.index')->with('error', 'Thêm mới nhân viên không thành công!');
    }
    public function edit($id){
        $major = $this->majorRepositories->findById($id);
        $config['seo'] = config('apps.major');
        $config['method'] = 'edit';
        $template = 'backend.major.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'major',
        ));
    }
    public function update($id, UpdateMajorRequest $request){
        if($this->majorervice->update($id, $request)){
            return redirect()->route('major.index')->with('success', 'Cập nhật nhân viên thành công!');
           };
           return redirect()->route('major.index')->with('error', 'Cập nhật nhân viên không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.major');
        $major = $this->majorRepositories->findById($id);
        $template = 'backend.major.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'major',
        ));
    }
    public function destroy($id){
        if($this->majorService->destroy($id)){
            return redirect()->route('major.index')->with('success', 'Xóa nhân viên thành công!');
           };
           return redirect()->route('major.index')->with('error', 'Xóa nhân viên không thành công!');
    }

}