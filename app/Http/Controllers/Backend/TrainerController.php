<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use App\Models\Major;
use App\Repositories\Interfaces\MajorRepositoriesInterface as MajorReposiudtories;
use App\Repositories\Interfaces\ProvinceRepositoriesInterface as ProvinceRepository;
use App\Repositories\Interfaces\TrainerRepositoriesInterface as TrainerRepositories;
use App\Services\TrainerService;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    protected $trainerService;

    protected $majorRepositories;

    protected $provinceRepositories;

    protected $trainerRepositories;

    public function __construct(
        TrainerService $trainerService,
        MajorReposiudtories $majorRepositories,
        ProvinceRepository $provinceRepositories,
        TrainerRepositories $trainerRepositories,
    ) {
        $this->trainerService = $trainerService;
        $this->majorRepositories = $majorRepositories;
        $this->provinceRepositories = $provinceRepositories;
        $this->trainerRepositories = $trainerRepositories;
    }

    public function index(Request $request)
    {
        $genderLabels = config('apps.trainer.create.genderLabels');
        $trainers = $this->trainerService->getAllPaginate($request);
        $majors = Major::all();
        $config['seo'] = config('apps.trainer');
        $template = 'backend.trainer.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'genderLabels',
            'majors',
            'trainers'
        ));

    }

    public function create()
    {
        $majors = $this->majorRepositories->all();
        $genderLabels = config('apps.trainer.create.genderLabels');
        $provinces = $this->provinceRepositories->all();
        $config = [
            'css' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/plugin/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',

            ],
        ];
        $config['seo'] = config('apps.trainer');
        $config['method'] = 'create';
        $template = 'backend.trainer.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'genderLabels',
            'provinces',
            'majors'
        ));
    }

    public function save(SaveTrainerRequest $request)
    {
        if ($this->trainerService->create($request)) {
            return redirect()->route('trainer.index')->with('success', 'Thêm mới nhân viên thành công!');
        }

        return redirect()->route('trainer.index')->with('error', 'Thêm mới nhân viên không thành công!');
    }

    public function edit($id)
    {
        $genderLabels = config('apps.trainer.create.genderLabels');
        $majors = $this->majorRepositories->all();
        $trainer = $this->trainerRepositories->findByIdWithMajors($id);
        $provinces = $this->provinceRepositories->all();

        $config = [
            'css' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/plugin/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',

            ],
        ];
        $config['seo'] = config('apps.trainer');
        $config['method'] = 'edit';
        $template = 'backend.trainer.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'genderLabels',
            'majors',
            'trainer'
        ));
    }

    public function update($id, UpdateTrainerRequest $request)
    {
        if ($this->trainerService->update($id, $request)) {
            return redirect()->route('trainer.index')->with('success', 'Cập nhật nhân viên thành công!');
        }

        return redirect()->route('trainer.index')->with('error', 'Cập nhật nhân viên không thành công!');
    }

    public function delete($id)
    {
        $config['seo'] = config('apps.trainer');
        $majors = $this->majorRepositories->all();
        $trainer = $this->trainerRepositories->findById($id);
        $template = 'backend.trainer.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'trainer',
            'majors'
        ));
    }

    public function destroy($id)
    {
        if ($this->trainerService->destroy($id)) {
            return redirect()->route('trainer.index')->with('success', 'Xóa huấn luyện viên thành công!');
        }

        return redirect()->route('trainer.index')->with('error', 'Xóa huấn luyện viên không thành công!');
    }
}
