<?php

namespace App\Services;

use App\Repositories\Interfaces\RoomRepositoriesInterface as RoomRepositories;
use App\Services\Interfaces\RoomServiceInterface;
use Illuminate\Support\Facades\DB;

/**
 * room roomService
 */
class RoomService implements RoomServiceInterface
{
    protected $roomRepositories;

    public function __construct(
        RoomRepositories $roomRepositories
    ) {
        $this->roomRepositories = $roomRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $rooms = $this->roomRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/room/index']
        );

        return $rooms;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $room = $this->roomRepositories->create($payload);
            DB::commit();

            return [
                'room' => $room,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            exit();

            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $room = $this->roomRepositories->update($id, $payload);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            exit();

            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $room = $this->roomRepositories->delete($id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            exit();

            return false;
        }
    }

    public function paginateSelect()
    {
        return [
            'id',
            'name',
            'class_id',
        ];
    }
}
