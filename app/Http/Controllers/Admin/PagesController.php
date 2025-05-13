<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Pages;
use App\Traits\FileHandler;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    use FileHandler;

    protected $page;
    public function __construct()
    {
        $this->page = new Pages();
    }


    public function index()
    {
        $query = Pages::query()->orderBy('id','ASC');
        if(request()->input('title')  != ''){
            $query = $query->where('title', "like" ,'%' . request()->input('title') . '%');
        }
        $items = $query->paginate($this->pagination_count);

        return view('admin.dashboard.pages.index', compact('items'));
    }

    public function create()
    {
        return view('admin.dashboard.pages.create');
    }


    public function store(PageRequest $request)
    {
        $data =$request->getSanitized();
        if($request->hasFile('image')){
            $data['image'] = $this->storeImage2($request , $this->page->path() ,$request->image ,'image');
        }
        Pages::create($data);
        session()->flash('success' , "لقد ادخلت هذة الصفحة بنجاح" );
        return back();
    }


    public function show( Pages $page)
    {
        return view('admin.dashboard.pages.show' , compact('page'));
    }


    public function edit( Pages $page)
    {
        return view('admin.dashboard.pages.edit' , compact('page'));
    }


    public function update(PageRequest $request, Pages $page)
    {
        $data =$request->getSanitized();
        if ($request->hasFile('image')) {
            $data['image'] = $this->updateImage($request , $page , $this->page->path() ,$request->image ,'image');
        }
        $page->update($data);
        session()->flash('success' ,  "لقد قمت بتعدل هذة الصفحة بنجاح" );
        return redirect()->back();
    }


    public function destroy(Pages $page)
    {

        $this->deleteImage($page , 'image');
        $page->delete();
        session()->flash('success' , trans('message.admin.deleted_sucessfully') );
        return redirect()->back();
    }


    public function update_status($id){
        $page = Pages::findOrfail($id);
        $page->status == 1 ? $page->status = 0 : $page->status = 1;
        $page->save();
        return redirect()->back();
    }

    public function actions(Request $request){
        if($request['publish'] == 1 ){
            $pages = Pages::findMany($request['record']);
            foreach ($pages as $page){
                $page->update(['status' => 1]);
            }
            session()->flash('success' , trans('pages.status_changed_sucessfully') );
        }
        if($request['unpublish'] == 1 ){
            $pages = Pages::findMany($request['record']);
            foreach ($pages as $page){
                $page->update(['status' => 0]);
            }
            session()->flash('success' , trans('pages.status_changed_sucessfully') );
        }
        if($request['delete_all'] == 1 ){
            $pages = Pages::findMany($request['record']);
            foreach ($pages as $page){
                $this->deleteImage($page , 'image');
                $page->delete();
            }
            session()->flash('success' , trans('pages.delete_all_sucessfully') );
        }
        return redirect()->back();
    }


}
