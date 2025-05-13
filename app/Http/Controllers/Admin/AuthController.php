<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function login(Request $request)
    {

        return view("admin.auth.login");
    }

    function postLogin(Request $request)
    {
        $request->validate([
            'email' => "required|email|min:3",
            'password' => "required|min:3"
        ]);
        $credentials = $request->only('email', 'password');
        $admin = Admin::where(['email' => $request->email])->first();
        if ($admin) {
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route("admin.home")
                    ->withSuccess('Signed in');
            }
        }
        return redirect()->route("admin.login")->withErrors('Login details are not valid');

    }


    function do_login(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            'password' => "required"
        ]);
        $credentials = $request->only('email', 'password');
        $user = Admin::where(['email' => $request->email])->first();
        if ($user) {
            if ($user->hasRole(['Super-Admin',"admin","Data-Entry","Driver","Accountant","ImagesApproval"])) {
                if (Auth::attempt($credentials)) {
                    return redirect()->route("admin.home")
                        ->withSuccess('Signed in');
                }
            }
        }

        return redirect()->route("admin.login")->withErrors('Login details are not valid');


        // return redirect()->back()->withErrors("اسم المستخدم أو كلمة المرور غير صحيحة");

    }

    function logout()
    {

        Session::flush();
        Auth::guard("admin")->logout();
        return redirect()->route("admin.home");
    }
}
