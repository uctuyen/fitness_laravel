<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositories\CustomerRepositories;
use App\Services\CustomerService;


class CustomerController extends Controller
{
    public function __construct(
        CustomerRepositories $customerRepositories,
        CustomerService $customerService
    ) {
        $this->customerRepositories = $customerRepositories;
        $this->customerService = $customerService;
    }
    public function index(Request $request)
    {
        $customers = Customer::query();
        if (! empty($request->keyword)) {
            $customers = $customers->where('name', 'like', '%'.$request->keyword.'%')
                ->orWhere('email', 'like', '%'.$request->keyword.'%')
                ->orWhere('phone_number', 'like', '%'.$request->keyword.'%')
                ->orWhere('address', 'like', '%'.$request->keyword.'%');
        }
        $customers = $customers->paginate($request->perpage ?? 20);

        $config['seo'] = config('apps.customer');
        $template = 'backend.customer.index';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'customers',
        ));
    }

    public function delete($id)
    {
        $config['seo'] = config('apps.customer');
        $customer = $this->customerRepositories->findById($id);
        $template = 'backend.customer.delete';

        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'customer',
        ));
    }

    public function destroy($id)
    {
        if ($this->customerService->destroy($id)) {
            return redirect()->route('customer.index')->with('success', 'Xóa khách hàng học thành công!');
        }

        return redirect()->route('customer.index')->with('error', 'Xóa khách hàng học không thành công!');
    }
}
