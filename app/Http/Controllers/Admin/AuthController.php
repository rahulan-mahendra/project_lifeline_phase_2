<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('web')->except('logout');
    }

    public function loginPage(Request $request)
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if(!($user->is_active == 1)){
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'This account is not active. Please contact your admin']);
            }
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records']);
    }

    public function logout()
    {
        $user = Auth::user();
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }

}
