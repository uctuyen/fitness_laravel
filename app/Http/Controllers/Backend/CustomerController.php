<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request){
        $customers = Customer::query();
        if (!empty($request->keyword)) {
            $customers = $customers->where('name','like','%'.$request->keyword.'%')
                ->orWhere('email','like','%'.$request->keyword.'%')
                ->orWhere('phone_number','like','%'.$request->keyword.'%')
                ->orWhere('address','like','%'.$request->keyword.'%');
        }
        $customers = $customers->paginate($request->perpage ?? 20);

        $config['seo'] = config('apps.customer');
        $template = 'backend.customer.index';
        return view('backend.dashboard.layout',compact(
            'template',
            'config',
            'customers',
        ));
    }
    public function destroy($id){
        if (Customer::destroy($id)) {
            return redirect()->route('customer.index')->with('success', 'Xóa khách thành công!');
        }

        return redirect()->route('customer.index')->with('error', 'Xóa khách không thành công!');
    }
}
