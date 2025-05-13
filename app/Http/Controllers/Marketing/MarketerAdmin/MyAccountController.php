<?php

namespace App\Http\Controllers\Marketing\MarketerAdmin;

use App\Http\Controllers\Controller;
use App\Models\MarketerAdmin;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function showMyAccount()
    {
        $marketer = MarketerAdmin::findOrFail(auth()->guard('marketer_admin')->id());
        return view('marketer_admin/my_account/edit' , compact('marketer' ));
    }

    public function updateMarketerAdmin(Request $request)
    {
        $marketer = MarketerAdmin::findOrFail(auth()->guard('marketer_admin')->id());
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:marketer_admins,email,' . $marketer->id,
            'mobile' => 'nullable|digits:12|starts_with:966|unique:marketer_admins,mobile,' . $marketer->id,
        ]);
        $row = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];
        $marketer->update($row);
        toastr()->success('لقد عدلت   الحساب بنجاح');
        return redirect()->back();
    }

}
