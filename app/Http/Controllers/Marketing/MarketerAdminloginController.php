<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketerAdminloginController extends Controller
{
    public function showLoginForm()
    {
        return view('marketer_admin/auth/login');
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('marketer_admin')->attempt($credentials)) {
           return   redirect()->intended('/marketer_admin/dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function dashboard()
    {
        return view('/marketer_admin/home');
    }



}
