<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ProfileRequest;
use App\Models\Favorite;
use App\Models\Order;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function index(){
        $query = Order::with(['payment_type', 'order_status'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
        $totalOrders =  (clone $query)->get()->Sum('total');
        $ordersCount = $query->count();
        return view('client.profile.index', compact('totalOrders', 'ordersCount'));
    }

    public function orders(){
        return view('client.profile.orders');
    }

    public function favoriteMosque(){
        $user = auth()->user();
        $favorites = Favorite::where('user_id', $user->id)->get();
        return view('client.profile.favorite-mosque', compact('favorites'));
    }

    public function edit(){
        return view('client.profile.edit');
    }
   
    public function update(ProfileRequest $request){
        $data = $request->validated();
        $user = auth()->user();
        $user->update($data);
        toastr()->success('لقد تم التعديل بنجاح');

        return redirect()->route('client.profile.index');
    }

    public function notifications(){
        $user = auth()->user();
        return view('client.profile.notifications', compact('user'));
    }


    public function notificationsUpdate(Request $request){
        $user = auth()->user();
        $user->order_notifications = $request->order_notifications == "on" ? 1 : 0;
        $user->promotion_notifications = $request->promotion_notifications == "on" ? 1 : 0;
        $user->save();
        toastr()->success('لقد تم التعديل بنجاح');
        return redirect()->route('client.profile.notifications');
    }


    public function OrderInvoices($id){
        $order = Order::with(['details', 'payment_type', 'order_status'])->where('id', $id)->first();
        if(@$order->user->id != @auth()->guard('web')->user()?->id){
            return redirect()->route('client.login');
        }
        return view('client.profile.order-invoices', compact('order'));
    }

    public function OrderTracking($id){
        $order = Order::with(['details', 'payment_type', 'order_status'])->where('id', $id)->first();
        if(@$order->user->id != @auth()->guard('web')->user()?->id){
            return redirect()->route('client.login');
        }
        return view('client.profile.order-tracking', compact('order'));
    }
}
