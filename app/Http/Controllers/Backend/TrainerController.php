<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\TrainerService;
use App\Models\Trainer;

use App\Repositories\Interfaces\ProvinceRepositoriesInterface as ProvinceRepository;
use App\Repositories\Interfaces\TrainerRepositoriesInterface as TrainerRepositories;
use App\Http\Requests\SaveTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use Illuminate\Http\Request;
use App\Models\Major;
class TrainerController extends Controller
{
    protected $trainerService;
    protected $trainerRepositories;
    protected $provinceRepositories;
    public function __construct(
        TrainerService $trainerService,
        TrainerRepositories $trainerRepositories,
        ProvinceRepository $provinceRepositories,
    ){
        $this->trainerService = $trainerService; 
        $this->trainerRepositories = $trainerRepositories; 
        $this->provinceRepositories = $provinceRepositories; 
    }
    

    public function index(Request $request){
        $genderLabels = config('apps.trainer.create.genderLabels');
        $trainers = $this->trainerService->getAllPaginate($request);
        
        $majors = Major::all();
        
        $config['seo'] = config('apps.trainer');
        $template = 'backend.trainer.index';
        
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'genderLabels',
            'majors',
            'trainers'
        ));
        
    }
    public function create(){
        $trainer = new Trainer;
        $majors = Major::all();
        $genderLabels = config('apps.trainer.create.genderLabels');
        $provinces = $this->provinceRepositories->all();
        $config = [
            'css' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js'
            ],
        ];  
        $config['seo'] = config('apps.trainer');
        $config['method'] = 'create';
        $template = 'backend.trainer.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'genderLabels',
            'provinces',
            'trainer',
            'majors'
        ));
    }
    public function save(SaveTrainerRequest $request){
       if($this->trainerService->create($request)){
        return redirect()->route('trainer.index')->with('success', 'Thêm mới nhân viên thành công!');
       };
       return redirect()->route('trainer.index')->with('error', 'Thêm mới nhân viên không thành công!');
    }
    public function edit($id){
        $genderLabels = config('apps.trainer.create.genderLabels');
        $trainer = $this->trainerRepositories->findById($id);
        $provinces = $this->provinceRepositories->all();
        $majors = Major::all();
        
        $config = [
            'css' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js'
            ],
        ];
        $config['seo'] = config('apps.trainer');
        $config['method'] = 'edit';
        $template = 'backend.trainer.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'trainer',
            'provinces',
            'genderLabels',
            'majors'
        ));
    }
    public function update($id, UpdateTrainerRequest $request){
        if($this->trainerService->update($id, $request)){
            return redirect()->route('trainer.index')->with('success', 'Cập nhật nhân viên thành công!');
           };
           return redirect()->route('trainer.index')->with('error', 'Cập nhật nhân viên không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.trainer');
        $majors = Major::all();
        $trainer = $this->trainerRepositories->findById($id);
        $template = 'backend.trainer.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'trainer',
            'majors'
        ));
    }
    public function destroy($id){
        if($this->trainerService->destroy($id)){
            return redirect()->route('trainer.index')->with('success', 'Xóa nhân viên thành công!');
           };
           return redirect()->route('trainer.index')->with('error', 'Xóa nhân viên không thành công!');
    }
}