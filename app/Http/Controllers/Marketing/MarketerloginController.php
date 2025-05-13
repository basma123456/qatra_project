<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketerloginController extends Controller
{

    public function showLoginForm()
    {
        return view('marketer/auth/login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('marketer')->attempt($credentials)) {
            return redirect()->intended('/marketer/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function dashboard()
    {
        return view('/marketer/home');
    }
}
