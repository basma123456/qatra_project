<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdsRequest;
use App\Models\Ads;
use App\Traits\FileHandler;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    use FileHandler;

    protected $ad;
    public function __construct()
    {
        $this->ad = new Ads();
    }


    public function index()
    {
        $query = Ads::query()->orderBy('id','ASC');
        if(request()->input('title')  != ''){
            $query = $query->where('title', "like" ,'%' . request()->input('title') . '%');
        }
        $items = $query->paginate($this->pagination_count);

        return view('admin.dashboard.ads.index', compact('items'));
    }

    public function create()
    {
        return view('admin.dashboard.ads.create');
    }


    public function store(AdsRequest $request)
    {
        $data =$request->getSanitized();
        if($request->hasFile('image')){
            $data['image'] = $this->storeImage2($request , $this->ad->path() ,$request->image ,'image');
        }
        if($request->hasFile('logo')){
            $data['logo'] = $this->storeImage2($request , $this->ad->pathLogo() ,$request->logo ,'logo');
        }

        Ads::create($data);
        session()->flash('success' , "لقد ادخلت هذا الاعلان  بنجاح" );
        return back();
    }


    public function show( Ads $ad)
    {
        return view('admin.dashboard.ads.show' , compact('ad'));
    }


    public function edit( Ads $ad)
    {
        return view('admin.dashboard.ads.edit' , compact('ad'));
    }


    public function update(AdsRequest $request, Ads $ad)
    {
        $data =$request->getSanitized();
        if ($request->hasFile('image')) {
            $data['image'] = $this->updateImage($request , $ad , $this->ad->path() ,$request->image ,'image');
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->updateImage($request , $ad , $this->ad->pathLogo() ,$request->logo ,'logo');
        }

        $ad->update($data);
        session()->flash('success' ,  "لقد قمت بتعدل هذا الاعلان  بنجاح" );
        return redirect()->back();
    }


    public function destroy(Ads $ad)
    {

        $this->deleteImage($ad , 'image');
        $this->deleteImage($ad , 'logo');

        $ad->delete();
        session()->flash('success' , trans('message.admin.deleted_sucessfully') );
        return redirect()->back();
    }


    public function update_status($id){
        $ad = Ads::findOrfail($id);
        $ad->status == 1 ? $ad->status = 0 : $ad->status = 1;
        $ad->save();
        return redirect()->back();
    }

    public function update_feature($id){
        $ad = Ads::findOrfail($id);
        $ad->feature == 1 ? $ad->feature = 0 : $ad->feature = 1;
        $ad->save();
        return redirect()->back();
    }




    public function actions(Request $request){
        if($request['publish'] == 1 ){
            $ads = Ads::findMany($request['record']);
            foreach ($ads as $ad){
                $ad->update(['status' => 1]);
            }
            session()->flash('success' , trans('ads.status_changed_sucessfully') );
        }
        if($request['unpublish'] == 1 ){
            $ads = Ads::findMany($request['record']);
            foreach ($ads as $ad){
                $ad->update(['status' => 0]);
            }
            session()->flash('success' , trans('ads.status_changed_sucessfully') );
        }
        if($request['delete_all'] == 1 ){
            $ads = Ads::findMany($request['record']);
            foreach ($ads as $ad){
                $this->deleteImage($ad , 'image');
                $ad->delete();
            }
            session()->flash('success' , trans('ads.delete_all_sucessfully') );
        }
        return redirect()->back();
    }

}
