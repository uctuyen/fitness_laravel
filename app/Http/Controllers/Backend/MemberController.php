<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use App\Models\Member;

use App\Repositories\Interfaces\ProvinceRepositoriesInterface as ProvinceRepository;
use App\Repositories\Interfaces\MemberRepositoriesInterface as MemberRepositories;
use App\Http\Requests\SaveMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberService;
    protected $memberRepositories;
    protected $provinceRepositories;
    public function __construct(
        MemberService $memberService,
        MemberRepositories $memberRepositories,
        ProvinceRepository $provinceRepositories,
    ){
        $this->memberService = $memberService; 
        $this->memberRepositories = $memberRepositories; 
        $this->provinceRepositories = $provinceRepositories; 
    }

    public function index(Request $request){
        $genderLabels = config('apps.member.create.genderLabels');
        $members = $this->memberService->getAllPaginate($request);     

        // dd($members);
        $config['seo'] = config('apps.member');
        $template = 'backend.member.index';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'members',
            'genderLabels',
        ));
        
    }
    public function create(){
        $member = new Member;
        $genderLabels = config('apps.member.create.genderLabels');
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
        $config['seo'] = config('apps.member');
        $config['method'] = 'create';
        $template = 'backend.member.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'genderLabels',
            'provinces',
            'member',
        ));
    }
    public function save(SaveMemberRequest $request){
       if($this->memberService->create($request)){
        return redirect()->route('member.index')->with('success', 'Thêm mới nhân viên thành công!');
       };
       return redirect()->route('member.index')->with('error', 'Thêm mới nhân viên không thành công!');
    }
    public function edit($id){
        $genderLabels = config('apps.member.create.genderLabels');
        $member = $this->memberRepositories->findById($id);
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
        $config['seo'] = config('apps.member');
        $config['method'] = 'edit';
        $template = 'backend.member.save';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'member',
            'provinces',
            'genderLabels',
        ));
    }
    public function update($id, UpdateMemberRequest $request){
        if($this->memberService->update($id, $request)){
            return redirect()->route('member.index')->with('success', 'Cập nhật nhân viên thành công!');
           };
           return redirect()->route('member.index')->with('error', 'Cập nhật nhân viên không thành công!');
    }
    public function delete($id){
        $config['seo'] = config('apps.member');
        $member = $this->memberRepositories->findById($id);
        $template = 'backend.member.delete';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'member',
        ));
    }
    public function destroy($id){
        if($this->memberService->destroy($id)){
            return redirect()->route('member.index')->with('success', 'Xóa nhân viên thành công!');
           };
           return redirect()->route('member.index')->with('error', 'Xóa nhân viên không thành công!');
    }
    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }
}
