<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marketer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MarketerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketers = Marketer::withSum('orders' , 'total')->latest()->paginate(20);
        return view("admin.marketers.index", compact("marketers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.marketers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|nullable|unique:marketers,email',
            'mobile' => 'required|digits:12|starts_with:966|unique:marketers,mobile',
            'password' => 'required|string|max:100|min:8',
        ]);
        $row = $request->all();


        do {
            $row['browse_code'] = Str::random(12);
            $row['affiliate_code'] = Str::random(6);
            $row['password'] = Hash::make($request->password);
            $row['marketer_admin_id'] = $request->marketer_admin_id;
            $marketer = Marketer::create($row);


        } while ($marketer == false);
        return redirect()->route("admin.marketer.index");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Marketer $marketer
     * @return \Illuminate\Http\Response
     */
    public function show(Marketer $marketer)
    {

        return view('admin/marketers/show', compact('marketer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Marketer $marketer
     * @return \Illuminate\Http\Response
     */
    public function edit(Marketer $marketer)
    {
        return view("admin.marketers.edit", compact("marketer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Marketer $marketer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marketer $marketer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|nullable|unique:marketers,email,' . $marketer->id,
            'mobile' => 'required|digits:12|starts_with:966|unique:marketers,mobile,' . $marketer->id,
        ]);
        $row = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'marketer_admin_id' =>$request->marketer_admin_id,
        ];
        $marketer->update($row);
        return redirect()->route("admin.marketer.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Marketer $marketer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marketer $marketer)
    {
        $marketer->delete();
        return redirect()->route("admin.marketer.index");
    }


}
