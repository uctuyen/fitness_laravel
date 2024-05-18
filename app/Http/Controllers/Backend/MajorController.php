<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Repositories\Interfaces\MajorRepositoriesInterface as MajorRepositories;
use App\Services\MajorService;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    protected $majorService;

    protected $majorRepositories;

    public function __construct(
        MajorService $majorService,
        MajorRepositories $majorRepositories,
    ) {
        $this->majorService = $majorService;
        $this->majorRepositories = $majorRepositories;
    }

    public function index(Request $request)
    {
        $majors = $this->majorService->getAllPaginate($request);
        $config['seo'] = config('apps.major');
        $template = 'backend.major.index';

        return view('backend.dashboard.layout', compact(
            'majors',
            'template',
            'config',
        ));

    }

    public function create()
    {
        $config['seo'] = config('apps.major');
        $config['method'] = 'create';
        $template = 'backend.major.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function save(SaveMajorRequest $request)
    {
        if ($this->majorService->create($request)) {
            return redirect()->route('major.index')->with('success', 'Thêm mới chuyên môn thành công!');
        }

        return redirect()->route('major.index')->with('error', 'Thêm mới chuyên môn không thành công!');
    }

    public function edit($id)
    {
        $major = $this->majorRepositories->findById($id);
        $config['seo'] = config('apps.major');
        $config['method'] = 'edit';
        $template = 'backend.major.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'major',
        ));
    }

    public function update($id, UpdateMajorRequest $request)
    {
        if ($this->majorService->update($id, $request)) {
            return redirect()->route('major.index')->with('success', 'Cập nhật chuyên môn thành công!');
        }

        return redirect()->route('major.index')->with('error', 'Cập nhật chuyên môn không thành công!');
    }

    public function delete($id)
    {
        $config['seo'] = config('apps.major');
        $major = $this->majorRepositories->findById($id);
        $template = 'backend.major.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'major',
        ));
    }

    public function destroy($id)
    {
        if ($this->majorService->destroy($id)) {
            return redirect()->route('major.index')->with('success', 'Xóa chuyên môn thành công!');
        }

        return redirect()->route('major.index')->with('error', 'Xóa chuyên môn không thành công!');
    }
}
