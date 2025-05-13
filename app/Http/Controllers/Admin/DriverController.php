<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::paginate(20);
        return view("admin.drivers.index",compact("drivers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.drivers.create");
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
            'name'=>'required',
            'email'=>'email|nullable|unique:drivers,email',
            'mobile'=>'required|digits:12|starts_with:966|unique:drivers,mobile',
            'password' => 'required|alpha_num|min:8',
        ]);
        $row = $request->all();
        $row['password'] = Hash::make($request->password);
        $driver = Driver::create($row);
        // $driver->assignRole('Driver');
        return redirect()->route("admin.driver.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        return view("admin.drivers.edit",compact("driver"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'email|nullable|unique:drivers,email,'.$driver->id,
            'mobile'=>'required|digits:12|starts_with:966|unique:drivers,mobile,'.$driver->id,
            'password' => 'nullable|alpha_num|min:8',
        ]);
        $row = [
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
        ];

        if(!is_null($request->password)){
            $row['password'] = Hash::make($request->password);
        }
        $driver->update($row);
        // $driver->assignRole('Driver');
        return redirect()->route("admin.driver.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route("admin.driver.index");
    }
}
