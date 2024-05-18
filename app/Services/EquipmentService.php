<?php

namespace App\Services;

use App\Repositories\Interfaces\EquipmentRepositoriesInterface as EquipmentRepositories;
use App\Services\Interfaces\EquipmentServiceInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class EquipmentService
 */
class EquipmentService implements EquipmentServiceInterface
{
    protected $equipmentRepositories;

    public function __construct(
        EquipmentRepositories $equipmentRepositories
    ) {
        $this->equipmentRepositories = $equipmentRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['gender'] = (int) $request->input('gender');

        $perPage = (int) $request->input('perpage');
        $equipments = $this->equipmentRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/equipment/index'], $perPage);

        return $equipments;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $equipment = $this->equipmentRepositories->create($payload);
            DB::commit();

            return [
                'equipment' => $equipment,
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
            // Tiếp tục thêm dữ liệu vào cơ sở dữ liệu
            $equipment = $this->equipmentRepositories->update($id, $payload);
            DB::commit();

            // return [
            //     'equipment' => $equipment,
            // ];
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
            $equipment = $this->equipmentRepositories->delete($id);
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
            'description',
            'image',
            'status',
            'quantity',
            'room_id',
        ];
    }
}
