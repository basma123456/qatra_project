<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverOrderRequest;
use App\Http\Requests\UpdateDriverOrderRequest;
use App\Models\DriverOrder;

class DriverOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDriverOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DriverOrder  $driverOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DriverOrder $driverOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DriverOrder  $driverOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DriverOrder $driverOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDriverOrderRequest  $request
     * @param  \App\Models\DriverOrder  $driverOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriverOrderRequest $request, DriverOrder $driverOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DriverOrder  $driverOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverOrder $driverOrder)
    {
        //
    }
}
