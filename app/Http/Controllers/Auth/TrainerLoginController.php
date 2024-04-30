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
    public function indexTrainer()
    {
        return view('backendTrainer.auth.login');
    }
    public function login (AuthRequest $request){
        if (Auth::guard('trainer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('trainer.dashboardTrainer')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->route('trainer.indexTrainer')->with('error', 'Email hoặc Password không chính xác!');
        }
    }

    public function logout()
    {
        Auth::guard('trainer')->logout();
        return redirect()->route('trainer.index');
    }
}
