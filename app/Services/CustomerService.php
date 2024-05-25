<?php

namespace App\Services;

use App\Repositories\Interfaces\CustomerRepositoriesInterface as CustomerRepositories;
use App\Services\Interfaces\CustomerServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class CustomerService
 */
class CustomerService implements CustomerServiceInterface
{
    protected $customerRepositories;

    public function __construct(
        CustomerRepositories $customerRepositories
    ) {
        $this->customerRepositories = $customerRepositories;
    }

    public function getAllPaginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = (int) $request->input('perpage');
        $customers = $this->customerRepositories->paginate($this->paginateSelect(),
            $condition,
            [],
            ['path' => '/customer/index'], $perPage);

        return $customers;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $customer = $this->customerRepositories->delete($id);
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
            'member_id',
            'calendar_id',
        ];
    }
}
