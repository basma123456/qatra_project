<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    function login(Request $request)
    {

        return view("driver.auth.login");
    }

    function postLogin(Request $request)
    {
        $request->validate([
            'email' => "required|email|min:3",
            'password' => "required|min:3"
        ]);
        $credentials = $request->only('email', 'password');
        $admin = Driver::where(['email' => $request->email])->first();
        if ($admin) {
            if (Auth::guard('driver')->attempt($credentials)) {
                return redirect()->route("drivers.home")
                    ->withSuccess('Signed in');
            }
        }
        return redirect()->route("drivers.login")->withErrors('Login details are not valid');

    }



    function logout()
    {

        Session::flush();
        Auth::guard("driver")->logout();
        return redirect()->route("drivers.home");
    }
}
