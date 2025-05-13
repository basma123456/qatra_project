<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DistrictRequest;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    
    public function index()
    {
        $query = District::query()->orderBy('id', 'DESC');
        if(request()->input('name')  != ''){
            $query = $query->where('name_ar', 'like','%' . request()->input('name') . '%')
            ->orWhere('name_en', 'like','%' . request()->input('name') . '%');
        }
        if(request()->input('city_id')  != ''){
            $query = $query->where('city_id', request()->input('city_id'));
        }
        $items = $query->paginate($this->pagination_count);

        $cities = City::get();
        return view('admin.districts.index', compact('items', 'cities'));
    }

    public function create()
    {
        $cities = City::get();
        return view('admin.districts.create', compact('cities'));
    }


    public function store(DistrictRequest $request)
    {
        $data =$request->getSanitized();
        District::create($data);
        session()->flash('success' , trans('message.admin.created_sucessfully') );
        if(request()->submit == "new"){ return  redirect()->back();}
        return redirect()->route('admin.districts.index');
    }


    public function show(District $district)
    {
        return view('admin.districts.show' , compact('district'));
    }


    public function edit(District $district)
    {
        $cities = City::get();
        return view('admin.districts.edit' , compact('district', 'cities'));
    }


    public function update(DistrictRequest $request, District $district)
    {
        $data = $request->getSanitized();
        $district->update($data);
        session()->flash('success' , trans('message.admin.updated_sucessfully') );
        if(request()->submit == "update"){ return  redirect()->back();}
        return redirect()->route('admin.districts.index');
    }


    public function destroy(District $district)
    {
        $this->delete_file($district->image);
        $district->delete();
        session()->flash('success' , trans('message.admin.deleted_sucessfully') );
        return redirect()->back();
    }


    public function update_status($id){
        $district = District::findOrfail($id);
        $district->status == 1 ? $district->status = 0 : $district->status = 1;
        $district->save();
        return redirect()->back();
    }

    public function actions(Request $request){
        if($request['publish'] == 1 ){
            $districts = District::findMany($request['record']);
            foreach ($districts as $district){
                $district->update(['status' => 1]);
            }
            session()->flash('success' , trans('admin.status_changed_sucessfully') );
        }
        if($request['unpublish'] == 1 ){
            $districts = District::findMany($request['record']);
            foreach ($districts as $district){
                $district->update(['status' => 0]);
            }
            session()->flash('success' , trans('admin.status_changed_sucessfully') );
        }
        if($request['delete_all'] == 1 ){
            $districts = District::findMany($request['record']);
            foreach ($districts as $district){
                $this->delete_file($district->image);
                $district->delete();
            }
            session()->flash('success' , trans('admin.delete_all_sucessfully') );
        }
        return redirect()->back();
    }

}
