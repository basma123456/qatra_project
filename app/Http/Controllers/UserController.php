<?php

namespace App\Http\Controllers;

use App\Helpers\Msegat;
use App\Helpers\Sender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function login(Request $request)
    {
        return view("front.users.login");
    }

    function login_post(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
        ]);
        $mobile = str_replace("+", "", $request->mobile);
        $user = User::where(['mobile' => $mobile])->first();
        $password = rand(1000, 9999);
        // if ($mobile == "966501201906") {
        //     $password = 1399;
        // }
        if ($user) {
            $user->password = Hash::make($password);
            $user->otp = $password;
            $user->save();
        } else {
            $request->validate([
                'mobile'=>"required|numeric"
            ]);
            User::create([
                // 'name' => "عميل",
                // 'email' => $mobile.".cus@qatra.sa",
                'mobile' => $mobile,
                'password' => Hash::make($password),
                'otp' => $password,
            ]);
        }
        // $sms = new Msegat();
        // if ($mobile != "966501201906") {
        //     $message = "رمز التحقق: " . $password;
        //     $sms->SendOTP($mobile, $message);
        // }
        // $message = [];
        // $message['whats'] = "رمز التحقق: " . $password . "\n منصة قطرة\n https://qatra.sa/";
        // $message['sms'] = "رمز التحقق: " . $password;
        $sender = new Sender();
        $sender->sendOTP($mobile,$password);
        
        
        $request->session()->put('mobile', $mobile);
        return redirect()->route("otp");
    }

    function otp(Request $request)
    {
        $mobile = $request->session()->get('mobile');
        return view("front.users.otp", compact("mobile"));
    }

    function otp_post(Request $request)
    {
        $mobile = $request->session()->get('mobile');
        $password = implode($request->digit);
        // return $mobile;
        if (Auth::attempt(['mobile' => $mobile, 'password' => $password])) {
            $request->session()->regenerate();
            if(session('link')){
                return redirect(session('link'));
            }
            return redirect()->intended("home");
        }
        // $user = User::find(Auth::user()->id);
        // $otp = implode($request->digit);
        // // return $otp;

        // if ($user->otp == $otp) {
        //     $user->email_verified_at = now();
        //     $user->save();
        //     return redirect()->route("front.home");
        // }
        return redirect()->back()->withErrors("رقم التحقق غير صحيح ");
    }

    function resend_otp(Request $request)
    {
        $mobile = $request->session()->get('mobile');
        $sms = new Msegat();
        $user = User::where('mobile', $mobile)->first();
        $sms->SendOTP($mobile, $user->otp);
    }
    function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route("front.home");
    }

    function account()
    {
        $user = Auth::user();
        // return "dsdsdds";
        return view("front.users.account", compact("user"));
    }

    function favorites(Request $request)
    {

        $favorites = Auth::user()->favorites;
        return view("front.users.favorites", compact("favorites"));
    }

    function add_favorite(Request $request)
    {
    }
    function remove_favorite(Request $request)
    {
    }
    function profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return view("front.users.profile", compact("user"));
    }
    function profile_post(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save(); //route('front.mosques')
        return redirect()->route("front.mosques")->with("success", "تم تعديل البيانات بنجاح");
    }
    // function password_post(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     $request->validate([
    //         'password_old' => 'required',
    //         'password' => 'required|alpha_num|confirmed|min:8',
    //         // 'password_confirmation'=>'required',
    //     ], [], ['password_old' => 'كلمة المرور السابقة']);
    //     if (Hash::check($request->password_old, $user->password)) {
    //         $user->password = Hash::make($request->password);
    //         $user->save();
    //         return redirect()->route("user.profile")->with("success", "تم تعديل كلمة المرور بنجاح");
    //     } else {
    //         return redirect()->route("user.profile")->with("error", "كلمة المرور السابقة غير صحيحة");
    //     }
    // }
}
