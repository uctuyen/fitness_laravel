<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Services\EquipmentService;
use App\Repositories\Interfaces\EquipmentRepositoriesInterface as EquipmentRepositories;
use App\Http\Requests\SaveEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
class EquipmentController extends Controller
{
    protected $equipmentService;
    protected $equipmentRepositories;
    public function __construct(
        EquipmentService $equipmentService,
        EquipmentRepositories $equipmentRepositories,
    ){
        $this->equipmentService = $equipmentService; 
        $this->equipmentRepositories = $equipmentRepositories; 
    }
    public function index(Request $request){
        $equipments = $this->equipmentService->getAllPaginate($request);

        $config['seo'] = config('apps.equipment');
        $template = 'backend.equipment.index';
        return view('backend.dashboard.layout',compact(
            'equipments',
            'template',
            'config',
        ));
        
    }

    public function create(){
        
        $config['seo'] = config('apps.equipment');
        $config['method'] = 'create';
        $template = 'backend.equipment.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
        ));
    }
    public function save(SaveEquipmentRequest $request){
        if($this->equipmentService->create($request)){
         return redirect()->route('equipment.index')->with('success', 'Thêm mới chuyên môn thành công!');
        };
        return redirect()->route('equipment.index')->with('error', 'Thêm mới chuyên môn không thành công!');
     }
    public function edit($id){
        $equipment = $this->equipmentRepositories->findById($id);
        $config['seo'] = config('apps.equipment');
        $config['method'] = 'edit';
        $template = 'backend.equipment.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'equipment',
        ));
    }
    
    public function update($id, UpdateEquipmentRequest $request){
        if($this->equipmentService->update($id, $request)){
            return redirect()->route('equipment.index')->with('success', 'Cập nhật chuyên môn thành công!');
        };
        return redirect()->route('equipment.index')->with('error', 'Cập nhật chuyên môn không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.equipment');
        $equipment = $this->equipmentRepositories->findById($id);
        $template = 'backend.equipment.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'equipment',
        ));
    }
    public function destroy($id){
        if($this->equipmentService->destroy($id)){
            return redirect()->route('equipment.index')->with('success', 'Xóa chuyên môn thành công!');
           };
           return redirect()->route('equipment.index')->with('error', 'Xóa chuyên môn không thành công!');
    }

}