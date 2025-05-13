<?php

namespace App\Http\Controllers\Marketing\Marketer;

use App\Http\Controllers\Controller;
use App\Models\Marketer;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function showMyAccount()
    {
        $marketer = Marketer::findOrFail(auth()->guard('marketer')->id());
        return view('marketer/my_account/edit', compact('marketer'));
    }

    public function updateMarketer(Request $request)
    {
        $marketer = Marketer::findOrFail(auth()->guard('marketer')->id());
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:marketers,email,' . $marketer->id,
            'mobile' => 'nullable|digits:12|starts_with:966|unique:marketers,mobile,' . $marketer->id,
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
