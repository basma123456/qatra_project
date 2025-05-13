<?php

namespace App\Http\Controllers\Marketing\MarketerAdmin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\MarketerAdminMiddleware;
use App\Models\Marketer;
use App\Models\Product;
use App\Settings\MarketersSingleton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Maatwebsite\Excel\Cache\has;

class ShowMarketersController extends Controller
{
    public function __construct()
    {
        $this->middleware(MarketerAdminMiddleware::class);
    }

    public function showMarketers()
    {
        $marketers = MarketersSingleton::getInstance()->getMarketersByMarketerAdmin(auth()->guard('marketer_admin')->id());
        return view('marketer_admin/marketers/index', compact('marketers'));
    }

    public function createMarketer()
    {
        return view('marketer_admin/marketers/create');
    }


    public function storeMarketer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|nullable|unique:marketers,email',
            'mobile' => 'required|digits:12|starts_with:966|unique:marketers,mobile',
            'password' => 'string',
        ]);

        $row = $request->all();


        do {
            $row['password'] = Hash::make('12345678');
            $row['browse_code'] = Str::random(12);
            $row['affiliate_code'] = Str::random(6);
            $row['marketer_admin_id'] = auth()->guard('marketer_admin')->id();

            $marketer = Marketer::create($row);
        } while ($marketer == false);
        toastr()->success('لقد ادخلت هذا المسوق بنجاح');
        return redirect()->route("marketer_admin.show_my_marketers");

    }



    public function showMarketer($marketerId)
    {
        $marketer = Marketer::findOrFail($marketerId);
        return view('marketer_admin/marketers/show' , compact('marketer'));
    }

    public function editMarketer($marketerId)
    {
        $products = Product::select('id' , 'name_ar')->get();
        $marketer = Marketer::findOrFail($marketerId);
        return view('marketer_admin/marketers/edit' , compact('marketer' , 'products'));
    }


    public function updateMarketer(Request $request,  $id)
    {
        $marketer = Marketer::findOrFail($id);
        $request->validate([
//            'name' => 'required',
//            'email' => 'nullable|email|unique:marketers,email,' . $marketer->id,
//            'mobile' => 'nullable|digits:12|starts_with:966|unique:marketers,mobile,' . $marketer->id,
        ]);
        $row = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];
        $marketer->update($row);
        toastr()->success('لقد عدلت هذا المسوق بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Marketer $marketer
     * @return \Illuminate\Http\Response
     */
    public function destroyMarketer(Marketer $marketer)
    {
        $marketer->delete();
        toastr()->success('لقد الغيت هذا المسوق بنجاح');
        return redirect()->route("marketer_admin.show_my_marketers");
    }

}
