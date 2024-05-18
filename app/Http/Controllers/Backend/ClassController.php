<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Models\Major;
use App\Models\Trainer;
use App\Repositories\Interfaces\ClassRepositoriesInterface as ClassRepositories;
use App\Services\ClassService;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    protected $classService;

    protected $classRepositories;

    public function __construct(
        ClassService $classService,
        ClassRepositories $classRepositories,
    ) {
        $this->classService = $classService;
        $this->classRepositories = $classRepositories;
    }

    public function index(Request $request)
    {
        $classes = $this->classService->getAllPaginate($request);
        $config['seo'] = config('apps.class');
        $template = 'backend.class.index';

        return view('backend.dashboard.layout', compact(
            'classes',
            'template',
            'config',
        ));

    }

    public function create()
    {
        $trainers = Trainer::all();
        $majors = Major::all();
        $config['seo'] = config('apps.class');
        $config['method'] = 'create';
        $template = 'backend.class.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'trainers',
            'majors'
        ));
    }

    public function save(SaveClassRequest $request)
    {
        if ($this->classService->create($request)) {
            return redirect()->route('class.index')->with('success', 'Thêm mới lớp học thành công!');
        }

        return redirect()->route('class.index')->with('error', 'Thêm mới lớp học không thành công!');
    }

    public function edit($id)
    {
        $class = $this->classRepositories->findById($id);
        $trainers = Trainer::all();
        $majors = Major::all();
        $config['seo'] = config('apps.class');
        $config['method'] = 'edit';
        $template = 'backend.class.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'class',
            'trainers',
            'majors'
        ));
    }

    public function update($id, UpdateClassRequest $request)
    {
        if ($this->classService->update($id, $request)) {
            return redirect()->route('class.index')->with('success', 'Cập nhật lớp học thành công!');
        }

        return redirect()->route('class.index')->with('error', 'Cập nhật lớp học không thành công!');
    }

    public function delete($id)
    {
        $config['seo'] = config('apps.class');
        $class = $this->classRepositories->findById($id);
        $template = 'backend.class.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'class',
        ));
    }

    public function destroy($id)
    {
        if ($this->classService->destroy($id)) {
            return redirect()->route('class.index')->with('success', 'Xóa lớp học thành công!');
        }

        return redirect()->route('class.index')->with('error', 'Xóa lớp học không thành công!');
    }
}
