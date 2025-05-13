<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Mosque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MosqueController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Auth::user();
        $cities = City::all();
        $districts = District::all();
        $query = Mosque::select("*");
        $row_per_page = 20;
        if(isset($request->district_id) && intval($request->district_id)>0){
            $query->where('district_id',$request->district_id);
            $row_per_page = 2000;
        }
        if(isset($request->city_id) && intval($request->city_id)>0){
            $query->where('city_id',$request->city_id);
            $row_per_page = 2000;
        }

        if($request->name){
            $query->where('name_ar','LIKE','%'.$request->name.'%');
            $row_per_page = 2000;
        }

        if(isset($request->status ) && $request->status > -1 ){
            $query->where('status',$request->status);
            $row_per_page = 2000;
        }


        $mosques = $query->paginate($row_per_page);


        $mosques_count = Mosque::count();
        // $mosques->withPath('/admin/users');
        $capacity = Mosque::sum("capacity");
        return view("admin.mosques.index", compact("cities", "districts", "mosques", "capacity", "mosques_count",'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $districts = District::all();
        return view("admin.mosques.create", compact("cities", "districts"));
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
            'name_ar' => 'required|string',
            'name_en' => 'nullable|string',
//            'latitude' => 'required|numeric',
//            'longitude' => 'required|numeric',
            // 'rows' => 'required|numeric',
            // 'row_length' => 'required|numeric',
            'city_id' => 'required|numeric',
            'district_id' => 'required|numeric',
        ]);
        $row = $request->all();
        $row['status'] = (isset($row['status'])) ? $row['status'] : 0;
        $row['is_full'] = (isset($row['is_full'])) ? $row['is_full'] : 0;
        $row['high_need'] = (isset($row['high_need'])) ? $row['high_need'] : 0;

        if (intval($row['rows']) > 0  && intval($row['row_length']) > 0)
            $row['capacity'] = intval($row['rows'] * $row['row_length'] / 0.4);
        Mosque::create($row);
        return redirect()->route("admin.mosque.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Mosque $mosque)
    {
        $cities = City::all();
        $districts = District::all();

//        $categories = Category::active()->select('id' , 'name_ar')->get();
        if (!$mosque) {
            session()->flash('error', trans('message.admin.not_found'));
            return redirect()->back();
        }
        return view('admin.mosques.show', compact("mosque", "cities", "districts"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function edit(Mosque $mosque)
    {
        $cities = City::all();
        $districts = District::all();
        return view("admin.mosques.edit", compact("mosque", "cities", "districts"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mosque $mosque)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'nullable|string',
//            'latitude' => 'required|numeric',
//            'longitude' => 'required|numeric',
            // 'rows' => 'required|numeric',
            // 'row_length' => 'required|numeric',
            'city_id' => 'required|numeric',
            'district_id' => 'required|numeric',
        ]);
        $row = $request->all();
        // return $request;
        $row['status'] = (isset($row['status'])) ? $row['status'] : 0;
        $row['is_full'] = (isset($row['is_full'])) ? $row['is_full'] : 0;
        $row['high_need'] = (isset($row['high_need'])) ? $row['high_need'] : 0;

        if (intval($row['rows']) > 0  && intval($row['row_length']) > 0)
            $row['capacity'] = intval($row['rows'] * $row['row_length'] / 0.4);
        $mosque->update($row);
        return redirect()->route("admin.mosque.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mosque $mosque)
    {
        $mosque->delete();
        return redirect()->route("admin.mosque.index");
    }




    public function update_status($id)
    {
        $mosque = Mosque::findOrfail($id);
        $mosque->status == 1 ? $mosque->status = 0 : $mosque->status = 1;
        $mosque->save();
        return redirect()->back();
    }

//    public function update_featured($id)
//    {
//        $mosque = Mosque::findOrfail($id);
//        $mosque->feature == 1 ? $mosque->feature = 0 : $mosque->feature = 1;
//        $mosque->save();
//        return redirect()->back();
//    }


    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $mosques = Mosque::findMany($request['record']);
            foreach ($mosques as $new) {
                $new->update(['status' => 1]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $mosques = Mosque::findMany($request['record']);
            foreach ($mosques as $new) {
                $new->update(['status' => 0]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $mosques = Mosque::findMany($request['record']);
            foreach ($mosques as $item) {
                $item->delete();
            }
            toastr()->success('لقد تم الالغاء بنجاح');
        }
        return redirect()->back();
    }



}
