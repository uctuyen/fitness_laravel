<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\classModel;
use App\Repositories\Interfaces\RoomRepositoriesInterface as RoomRepositories;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;

    protected $roomRepositories;

    public function __construct(
        RoomService $roomService,
        RoomRepositories $roomRepositories,
    ) {
        $this->roomService = $roomService;
        $this->roomRepositories = $roomRepositories;
    }

    public function index(Request $request)
    {

        $rooms = $this->roomService->getAllPaginate($request);
        $config['seo'] = config('apps.room');
        $template = 'backend.room.index';

        return view('backend.dashboard.layout', compact(
            'rooms',
            'template',
            'config',
        ));

    }

    public function create()
    {
        $classes = classModel::all();
        $config['seo'] = config('apps.room');
        $config['method'] = 'create';
        $template = 'backend.room.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'classes',
        ));
    }

    public function save(SaveRoomRequest $request)
    {
        if ($this->roomService->create($request)) {
            return redirect()->route('room.index')->with('success', 'Thêm mới phòng thành công!');
        }

        return redirect()->route('room.index')->with('error', 'Thêm mới phòng không thành công!');
    }

    public function edit($id)
    {
        $room = $this->roomRepositories->findById($id);
        $classes = classModel::all();
        $config['seo'] = config('apps.room');
        $config['method'] = 'edit';
        $template = 'backend.room.save';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'room',
            'classes',
        ));
    }

    public function update($id, UpdateRoomRequest $request)
    {
        if ($this->roomService->update($id, $request)) {
            return redirect()->route('room.index')->with('success', 'Cập nhật phòng thành công!');
        }

        return redirect()->route('room.index')->with('error', 'Cập nhật phòng không thành công!');
    }

    public function delete($id)
    {
        $config['seo'] = config('apps.room');
        $room = $this->roomRepositories->findById($id);
        $template = 'backend.room.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'room',
        ));
    }

    public function destroy($id)
    {
        if ($this->roomService->destroy($id)) {
            return redirect()->route('room.index')->with('success', 'Xóa phòng thành công!');
        }

        return redirect()->route('room.index')->with('error', 'Xóa phòng không thành công!');
    }
}
