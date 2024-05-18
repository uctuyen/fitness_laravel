<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;

class WebController extends Controller
{
    public function home() {
        return view('home');
    }

    public function registerCustomer(RegisterCustomerRequest $request) {
        Customer::create($request->all());

        return redirect()->back()->with('success', 'Đăng ký thành công!');
    }
}
