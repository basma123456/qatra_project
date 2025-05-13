<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    use FileHandler;

    protected $page;
    public function __construct()
    {
        $this->page = new PaymentMethod();
    }


    public function index()
    {
        $query = PaymentMethod::query()->orderBy('id','ASC');
        if(request()->input('title')  != ''){
            $query = $query->where('title', "like" ,'%' . request()->input('title') . '%');
        }
        if(request()->input('content')  != ''){
            $query = $query->where('content', "like" ,'%' . request()->input('content') . '%');
        }
        if(request()->input('status')  != ''){
            $query = $query->where('status', request()->input('status'));
        }

        $items = $query->paginate($this->pagination_count);

        return view('admin.dashboard.payment_methods.index', compact('items'));
    }

    public function create()
    {
        return view('admin.dashboard.payment_methods.create');
    }




    public function show( PaymentMethod $payment_method )
    {
        $payment_method->load('banks');
        return view('admin.dashboard.payment_methods.show' , compact('payment_method'));
    }


    public function edit( PaymentMethod $payment_method )
    {
        $payment_method->load('banks');
        return view('admin.dashboard.payment_methods.edit' , compact('payment_method'));
    }


    public function update(PaymentMethodRequest $request, PaymentMethod $payment_method)
    {
        $data =$request->getSanitized();
        if($request->hasFile('image')){
            @unlink($payment_method->image);
            $data['image'] = $this->upload_file($request->file('image') , ('payment_methods'));
        }
        $payment_method->update($data);
        session()->flash('success' ,  "لقد قمت بتعدل هذة الصفحة بنجاح" );
        return redirect()->back();
    }


    public function destroy(PaymentMethod $paymentMethod)
    {
        if($paymentMethod->banks()->count() > 0){
            session()->flash('error' , trans( 'هذة الوسيلة لها حسابات بنكية مرتبطة بها  قم بالغائها اولا ثم عاود الالغاء مرة اخري') );
            return redirect()->back();
        }
        Storage::delete($paymentMethod->image);
        $paymentMethod->delete();
        session()->flash('success' , trans('message.admin.deleted_sucessfully') );
        return redirect()->back();
    }


    public function update_status($id){
        $page = PaymentMethod::findOrfail($id);
        $page->status == 1 ? $page->status = 0 : $page->status = 1;
        $page->save();
        return redirect()->back();
    }

    public function actions(Request $request){
        if($request['publish'] == 1 ){
            $payment_methods = PaymentMethod::findMany($request['record']);
            foreach ($payment_methods as $page){
                $page->update(['status' => 1]);
            }
            session()->flash('success' , trans('payment_methods.status_changed_sucessfully') );
        }
        if($request['unpublish'] == 1 ){
            $payment_methods = PaymentMethod::findMany($request['record']);
            foreach ($payment_methods as $page){
                $page->update(['status' => 0]);
            }
            session()->flash('success' , trans('payment_methods.status_changed_sucessfully') );
        }
        if($request['delete_all'] == 1 ){
            $payment_methods = PaymentMethod::findMany($request['record']);
            foreach ($payment_methods as $page){
                $this->deleteImage($page , 'image');
                $page->delete();
            }
            session()->flash('success' , trans('payment_methods.delete_all_sucessfully') );
        }
        return redirect()->back();
    }


}
