<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
class TrainerLoginController extends Controller
{
    public function __construct(){

    }
    public function index()
    {
        return view('backendTrainer.auth.login');
    }
    public function login (AuthRequest $request){
        $credentials = [
            'email' =>  $request->input('email'),
            'password' =>  $request->input('password'),có 
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công!');
        }
        echo 2;
        return redirect()->route('auth.admin')->with('error','Email hoặc Password không chính xác!');
    }

    public function logout()
    {
        Auth::guard('trainer')->logout();
        return redirect()->route('auth.trainer');
    }
}
