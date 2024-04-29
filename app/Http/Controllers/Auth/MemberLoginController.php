<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberLoginController extends Controller
{
    public function __construct(){

    }
    public function index() : View
    {
        return view('backendMember.auth.login');
    }
    public function login (AuthRequest $request){
        $credentials = [
            'email' =>  $request->input('email'),
            'password' =>  $request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công!');
        }
        echo 2;
        return redirect()->route('auth.admin')->with('error','Email hoặc Password không chính xác!');
    }

    public function logout()
    {
        Auth::guard('Member')->megout();
        return redirect()->route('auth.member');
    }
}
