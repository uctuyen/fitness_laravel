<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerLoginController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        if (Auth::guard('trainer')->id() > 0) {
            return redirect()->route('trainer.dashboardTrainer');
        }

        return view('backendTrainer.auth.login');
    }

    public function login(AuthRequest $request)
    {
        if (Auth::guard('trainer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('trainer.dashboardTrainer')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->route('trainer.indexTrainer')->with('error', 'Email hoặc Password không chính xác!');
        }
    }

    public function trainerLogout(Request $request)
    {
        Auth::guard('trainer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('trainer.indexTrainer');
    }
}
