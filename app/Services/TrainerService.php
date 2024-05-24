<?php

namespace App\Services;

use App\Repositories\Interfaces\TrainerRepositoriesInterface as TrainerRepositories;
use App\Services\Interfaces\TrainerServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class TrainerService
 */
class TrainerService implements TrainerServiceInterface
{
    protected $trainerRepositories;

    public function __construct(
        TrainerRepositories $trainerRepositories
    ) {
        $this->trainerRepositories = $trainerRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['gender'] = (int) $request->input('gender');

        $perPage = (int) $request->input('perpage');
        $trainers = $this->trainerRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/trainer/index'], $perPage);

        return $trainers;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send', 're_password');
            $payload['password'] = Hash::make($payload['password']);
            $trainer = $this->trainerRepositories->create($payload);

            if ($trainer->id > 0) {
                $majors = $request->only('major_id');
                $trainer->majors()->sync($majors['major_id']);
            }

            DB::commit();

            return [
                'trainer' => $trainer,
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
            $trainer = $this->trainerRepositories->update($id, $payload);
            $majors = $request->only('major_id');
            $trainer->majors()->detach();
            $trainer->majors()->sync($majors['major_id']);
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
            $trainer = $this->trainerRepositories->findById($id);
            if (! $trainer) {
                return false;
            }
            $majorIds = $trainer->majors()->pluck('majors.id');
            DB::table('trainer_majors')->where('trainer_id', $id)->whereIn('major_id', $majorIds)->delete();
            $trainer->majors()->detach();
            $this->trainerRepositories->delete($id);
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
            'first_name',
            'last_name',
            'gender',
            'avatar',
            'phone_number',
            'email',
            'day_of_birth',
            'address',
        ];
    }
}
