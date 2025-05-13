<?php

namespace App\Http\Controllers\Marketing\Marketer;

use App\Http\Controllers\Controller;
use App\Models\Marketer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function showResetPasswordPage()
    {
        return view('marketer/auth/reset_password');
    }

    public function showResetPasswordPageStore(Request $request)
    {
        $myUser = Marketer::where('email', $request->email)->first();
        if (!$myUser) {
            toastr()->error('لا يوجد حساب لدينا بهذا الايميل');
            return redirect()->back();
        }
        $code = rand(10, 999999);  // Example data to pass to the email
        $myUser->remember_token = $code;
        $myUser->save();

            // Send the email to the recipient
        \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\MarketerResetPasswordMailable($code));
        toastr()->success('لقد تم ارسال كود لبريدك الالكتروني');
        return view('marketer/auth/reset_password_enter_code', ['email' => $request->email]);
    }


    public function showResetPasswordReceiveCode(Request $request)
    {
        $myUser = Marketer::where('email', $request->email)->first();
        if ($request->code !== $myUser->remember_token) {
            toastr()->error("عفوا الكود غير مطابق");
            return view('marketer/auth/reset_password_enter_code', ['email' => $request->email]);
        }
        toastr()->success('لقد ادخلت الكود بنجاح');

        return view('marketer/auth/reset_password_final_page', ['email' => $request->email]);
    }


    public function enterNewPassword(Request $request)
    {
        $myUser = Marketer::where('email', $request->email)->first();
        $myUser->password = Hash::make($request->password);
        $myUser->save();
        toastr()->success("لقد قمت بتعيين كلمة المرور بنجاح");

        return view('marketer/auth/login');
    }

}
