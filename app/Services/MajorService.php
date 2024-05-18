<?php

namespace App\Services;

use App\Repositories\Interfaces\MajorRepositoriesInterface as MajorRepositories;
use App\Services\Interfaces\MajorServiceInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class MajorService
 */
class MajorService implements MajorServiceInterface
{
    protected $majorRepositories;

    public function __construct(
        MajorRepositories $majorRepositories
    ) {
        $this->majorRepositories = $majorRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $majors = $this->majorRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/major/index']
        );

        return $majors;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $major = $this->majorRepositories->create($payload);
            DB::commit();

            return [
                'major' => $major,
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
            $major = $this->majorRepositories->update($id, $payload);
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
            $major = $this->majorRepositories->delete($id);
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
            'major_name',
            'description',
        ];
    }
}
