<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketerAdmin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MarketerAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketer_admins = MarketerAdmin::latest()->paginate(20);

        $order_statuses = [301,501,100];
//        foreach($marketers as $marketer){
//            $where = [
//                'marketer_id'=>$marketer->id,
//                // 'order_status_id'=>100,
//                // 'order_status_id'=>301,
//                // ['order_status_id','in',[301,100]]
//            ];
//            $marketer->total = Order::where($where)->whereIn('order_status_id', $order_statuses)->sum("total");
//        }
        return view("admin.marketer_admins.index", compact("marketer_admins"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.marketer_admins.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|nullable|unique:marketer_admins,email',
            'mobile' => 'required|digits:12|starts_with:966|unique:marketer_admins,mobile',
            'password' => 'required|string|max:100|min:8',
        ]);
        $row = $request->all();


        do {
//            $row['browse_code'] = Str::random(12);
//            $row['affiliate_code'] = Str::random(6);
            $row['password'] = Hash::make($request->password);

            $marketer = MarketerAdmin::create($row);
        } while ($marketer == false);
        return redirect()->route("admin.marketer_admin.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarketerAdmin  $marketer
     * @return \Illuminate\Http\Response
     */
    public function show($id )
    {
        $marketer_admin = MarketerAdmin::findOrFail($id);

        return  view('admin/marketer_admins/show' , compact('marketer_admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarketerAdmin  $marketer
     * @return \Illuminate\Http\Response
     */
    public function edit($id )
    {
        $marketerAdmin = MarketerAdmin::findOrFail($id);
        return view("admin.marketer_admins.edit", compact("marketerAdmin"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MarketerAdmin  $marketer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $marketer = MarketerAdmin::findOrFail($id);
//        $request->validate([
//            'name' => 'required',
//            'email' => 'email|nullable|unique:marketer_admins,email,' . $marketer->id,
//            'mobile' => 'nullable|required|digits:12|starts_with:966|unique:marketer_admins,mobile,' . $marketer->id,
//        ]);
        $request->validate([
            'name' => 'required',
            'email' => 'email|nullable',
            'mobile' => 'required|digits:12|starts_with:966',
        ]);

        $row = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];
        $marketer->update($row);
        return redirect()->route("admin.marketer_admin.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarketerAdmin  $marketer
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarketerAdmin $marketer_admin)
    {
        $marketer_admin->delete();
        return redirect()->route("admin.marketer_admin.index");
    }



}
