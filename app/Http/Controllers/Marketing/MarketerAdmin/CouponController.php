<?php

namespace App\Http\Controllers\Marketing\MarketerAdmin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Marketer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::paginate(20);
        return view("marketer_admin.coupons.index", compact("coupons"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Marketer $marketer)
    {
        $products = Product::all();
        return view("marketer_admin.coupons.create", compact("marketer", "products"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'code' => "required|unique:coupons,code",
                'marketer_id' => "required",
//                'product_id'=>"required",
                'products' => "required|array",
                'quantity' => "required",
            ]);
            $row = [
                'marketer_id' => $request->marketer_id,
//                'product_id'=>$request->product_id,
                'status' => 1,
                'quantity' => $request->quantity,
                'code' => $request->code,
            ];

            $coupone = Coupon::create($row);

            $coupone->products()->attach($request->products);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        toastr()->success('لقد ادخلت هذا الكوبون بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->products()->detach();
        $coupon->delete();
        toastr()->error('لقد الغيت هذا الكوبون بنجاح');
        return redirect()->back();

    }

    public function activate(Coupon $coupon)
    {
        $coupon->status = 1;
        $coupon->save();
        return redirect()->back();
    }

    public function deactivate(Coupon $coupon)
    {
        $coupon->status = 0;
        $coupon->save();
        return redirect()->back();
    }

}
