<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $query = City::query()->orderBy('id', 'DESC');
        if(request()->input('name')  != ''){
            $query = $query->where('name_ar', 'like','%' . request()->input('name') . '%')
            ->orWhere('name_en', 'like','%' . request()->input('name') . '%');

        }
        $items = $query->paginate($this->pagination_count);
        return view('admin.cities.index', compact('items'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }


    public function store(CityRequest $request)
    {
        $data =$request->getSanitized();
        City::create($data);
        session()->flash('success' , trans('message.admin.created_sucessfully') );
        if(request()->submit == "new"){ return  redirect()->back();}
        return redirect()->route('admin.cities.index');
    }


    public function show(City $city)
    {
        return view('admin.cities.show' , compact('city'));
    }


    public function edit(City $city)
    {
        return view('admin.cities.edit' , compact('city'));
    }


    public function update(CityRequest $request, City $city)
    {
        $data = $request->getSanitized();
        $city->update($data);
        session()->flash('success' , trans('message.admin.updated_sucessfully') );
        if(request()->submit == "update"){ return  redirect()->back();}
        return redirect()->route('admin.cities.index');
    }


    public function destroy(City $city)
    {
        $this->delete_file($city->image);
        $city->delete();
        session()->flash('success' , trans('message.admin.deleted_sucessfully') );
        return redirect()->back();
    }


    public function update_status($id){
        $city = City::findOrfail($id);
        $city->status == 1 ? $city->status = 0 : $city->status = 1;
        $city->save();
        return redirect()->back();
    }

    public function actions(Request $request){
        if($request['publish'] == 1 ){
            $cities = City::findMany($request['record']);
            foreach ($cities as $city){
                $city->update(['status' => 1]);
            }
            session()->flash('success' , trans('admin.status_changed_sucessfully') );
        }
        if($request['unpublish'] == 1 ){
            $cities = City::findMany($request['record']);
            foreach ($cities as $city){
                $city->update(['status' => 0]);
            }
            session()->flash('success' , trans('admin.status_changed_sucessfully') );
        }
        if($request['delete_all'] == 1 ){
            $cities = City::findMany($request['record']);
            foreach ($cities as $city){
                $this->delete_file($city->image);
                $city->delete();
            }
            session()->flash('success' , trans('admin.delete_all_sucessfully') );
        }
        return redirect()->back();
    }

}
