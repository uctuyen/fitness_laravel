<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberLoginController extends Controller
{
    public function __construct()
    {

    }

    public function index(): View
    {
        if (Auth::guard('member')->id() > 0) {
            return redirect()->route('member.dashboardMember');
        }

        return view('backendMember.auth.login');
    }

    public function login(AuthRequest $request)
    {
        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('member.dashboardMember')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->route('member.indexMember')->with('error', 'Email hoặc Password không chính xác!');
        }
    }

    public function memberLogout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('member.indexMember');
    }
}
