<?php

namespace App\Services;

use App\Repositories\Interfaces\MemberRepositoriesInterface as MemberRepositories;
use App\Services\Interfaces\MemberServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class MemberService
 */
class MemberService implements MemberServiceInterface
{
    protected $memberRepositories;

    public function __construct(
        MemberRepositories $memberRepositories
    ) {
        $this->memberRepositories = $memberRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['gender'] = (int) $request->input('gender');
        $perPage = (int) $request->input('perpage');
        $members = $this->memberRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/member/index'], $perPage);

        // dd($members);
        return $members;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send', 're_password');
            $payload['password'] = Hash::make($payload['password']);
            $member = $this->memberRepositories->create($payload);
            DB::commit();

            return [
                'member' => $member,
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
            $member = $this->memberRepositories->update($id, $payload);
            DB::commit();
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
            $member = $this->memberRepositories->delete($id);
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
