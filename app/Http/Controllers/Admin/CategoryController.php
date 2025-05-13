<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Mosque;
use App\Traits\FileHandler;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $query = Category::query()->orderBy('sort', 'ASC');
        if ($request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->name_ar != '') {

            $query = $query->where('name_ar', 'like','%' . request()->input('name_ar') . '%');
        }
        if ($request->description_ar != '') {
            $query = $query->where('description_ar', 'like','%' . request()->input('description_ar') . '%');
        }
        $items = $query->paginate($this->pagination_count);
        return view("admin.categories.index", compact("items"));
    }


    public function create()
    {
        return view("admin.categories.create" );
    }


    public function store(CategoryRequest $request)
    {
        Category::create($request->getSanitized())->refresh();

        toastr()->success('لقد تم التسجيل بنجاح');
        return back();
    }

    public function show(Request $request, Category $category)
    {
        if (!$category) {
            session()->flash('error', trans('message.admin.not_found'));
            return redirect()->back();
        }
        return view('admin.categories.show', compact('category' ));
    }


    public function edit(Request $request, Category $category)
    {
        if (!$category) {
            session()->flash('error', trans('message.admin.not_found'));
            return redirect()->back();
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->getSanitized();
        $category->update($data);
        toastr()->success('لقد تم التعديل بنجاح');
        return redirect()->back();
    }


    public function destroy(Category $category)
    {
        $category->delete();
        toastr()->success('لقد تم الالغاء بنجاح');
        return redirect()->back();
    }


    public function update_status($id)
    {
        $category = Category::findOrfail($id);
        $category->status == 1 ? $category->status = 0 : $category->status = 1;
        $category->save();
        return redirect()->back();
    }

    public function update_featured($id)
    {
        $category = Category::findOrfail($id);
        $category->feature == 1 ? $category->feature = 0 : $category->feature = 1;
        $category->save();
        return redirect()->back();
    }


    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $categories = Category::findMany($request['record']);
            foreach ($categories as $new) {
                $new->update(['status' => 1]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $categories = Category::findMany($request['record']);
            foreach ($categories as $new) {
                $new->update(['status' => 0]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $categories = Category::findMany($request['record']);
            foreach ($categories as $new) {
                $new->delete();
            }
            toastr()->success('لقد تم الالغاء بنجاح');
        }
        return redirect()->back();
    }


}
