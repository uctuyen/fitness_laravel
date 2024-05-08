<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\EmployeeService;
use App\Models\Employee;

use App\Repositories\Interfaces\ProvinceRepositoriesInterface as ProvinceRepository;
use App\Repositories\Interfaces\EmployeeRepositoriesInterface as EmployeeRepositories;
use App\Http\Requests\SaveEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{
    protected $employeeService;
    protected $employeeRepositories;
    protected $provinceRepositories;
    public function __construct(
        EmployeeService $employeeService,
        EmployeeRepositories $employeeRepositories,
        ProvinceRepository $provinceRepositories,
    ){
        $this->employeeService = $employeeService; 
        $this->employeeRepositories = $employeeRepositories; 
        $this->provinceRepositories = $provinceRepositories; 
    }
    

    public function index(Request $request){
        $genderLabels = config('apps.employee.create.genderLabels');
        $employees = $this->employeeService->getAllPaginate($request);
        $config['seo'] = config('apps.employee');
        $template = 'backend.employee.index';
        
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'employees',
            'genderLabels',
        ));
        
    }
    public function create(){
        $employee = new Employee;
        $genderLabels = config('apps.employee.create.genderLabels');
        $provinces = $this->provinceRepositories->all();
        $config = [
            'css' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/library/finder.js',
                'backend/plugin/ckfinder_2/ckfinder.js',
                'backend/library/finder.js'
            ],
        ];  
        $config['seo'] = config('apps.employee');
        $config['method'] = 'create';
        $template = 'backend.employee.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'genderLabels',
            'provinces',
            'employee',
        ));
    }
    public function save(SaveEmployeeRequest $request){
       if($this->employeeService->create($request)){
        return redirect()->route('employee.index')->with('success', 'Thêm mới nhân viên thành công!');
       };
       return redirect()->route('employee.index')->with('error', 'Thêm mới nhân viên không thành công!');
    }
    public function edit($id){
        $genderLabels = config('apps.employee.create.genderLabels');
        $employee = $this->employeeRepositories->findById($id);
        $provinces = $this->provinceRepositories->all();
        $config = [
            'css' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/plugin/ckfinder_2/ckfinder.js',
                'backend/library/finder.js'
            ],
        ];
        $config['seo'] = config('apps.employee');
        $config['method'] = 'edit';
        $template = 'backend.employee.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'employee',
            'provinces',
            'genderLabels',
        ));
    }
    public function update($id, UpdateEmployeeRequest $request){
        if($this->employeeService->update($id, $request)){
            return redirect()->route('employee.index')->with('success', 'Cập nhật nhân viên thành công!');
           };
           return redirect()->route('employee.index')->with('error', 'Cập nhật nhân viên không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.employee');
        $employee = $this->employeeRepositories->findById($id);
        $template = 'backend.employee.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'employee',
        ));
    }
    public function destroy($id){
        if($this->employeeService->destroy($id)){
            return redirect()->route('employee.index')->with('success', 'Xóa nhân viên thành công!');
           };
           return redirect()->route('employee.index')->with('error', 'Xóa nhân viên không thành công!');
    }
}