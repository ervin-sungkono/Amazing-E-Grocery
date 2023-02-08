<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request){
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->remember)) {
            request()->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return view('logout');
    }
}
