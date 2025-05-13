<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Mosque;
use App\Models\Product;
use App\Traits\FileHandler;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    use FileHandler;

    public function index(Request $request)
    {
        $query = Product::query()->orderBy('sort', 'ASC');
        if ($request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->name_ar != '') {

            $query = $query->where('name_ar', 'like', '%' . request()->input('name_ar') . '%');
        }
        if ($request->description_ar != '') {
            $query = $query->where('description_ar', 'like', '%' . request()->input('description_ar') . '%');
        }
        $items = $query->paginate($this->pagination_count);
        return view("admin.products.index", compact("items"));
    }


    public function create()
    {
        $mosques = Mosque::get();
        $categories = Category::active()->select('id', 'name_ar')->get();
        return view("admin.products.create", compact('categories', 'mosques'));
    }


    public function store(ProductRequest $request)
    {
        $product =  $request->product_id > 0 ? Product::where('id', $request->product_id)->first() : null;
        if (!$product) {
            $product = Product::create($request->getSanitized())->refresh();
        } else {
            $product->update($request->getSanitized());
        }
        $product->mosques()->sync($request->mosque_id);
        toastr()->success('لقد تم التسجيل بنجاح');
        return back();
    }


    public function show(Request $request, Product $product)
    {
        $categories = Category::active()->select('id', 'name_ar')->get();
        if (!$product) {
            session()->flash('error', trans('message.admin.not_found'));
            return redirect()->back();
        }
        return view('admin.products.show', compact('product', 'categories'));
    }


    public function edit(Request $request, Product $product)
    {
        $mosques = Mosque::get();

        $categories = Category::active()->select('id', 'name_ar')->get();
        if (!$product) {
            session()->flash('error', trans('message.admin.not_found'));
            return redirect()->back();
        }
        return view('admin.products.edit', compact('product', 'categories', 'mosques'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->getSanitized();
//        if ($request->hasFile('img')) {
//            $data['img'] = $this->updateImage($request, $product, Product::staticPath(), $request->img, 'img');
//        }
        $product->mosques()->sync($request->mosque_id);
        $product->update($data);
        toastr()->success('لقد تم التعديل بنجاح');
        return redirect()->back();
    }


    public function destroy(Product $product)
    {
        $this->deleteProductImages($product, 'img');
        $product->mosques()->delete();
        $product->delete();
        toastr()->success('لقد تم الالغاء بنجاح');
        return redirect()->back();
    }


    public function update_status($id)
    {
        $product = Product::findOrfail($id);
        $product->status == 1 ? $product->status = 0 : $product->status = 1;
        $product->save();
        return redirect()->back();
    }

    public function update_featured($id)
    {
        $product = Product::findOrfail($id);
        $product->feature == 1 ? $product->feature = 0 : $product->feature = 1;
        $product->save();
        return redirect()->back();
    }


    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $new) {
                $new->update(['status' => 1]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $new) {
                $new->update(['status' => 0]);
            }
            session()->flash('success', trans('articles.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $products = Product::findMany($request['record']);
            foreach ($products as $new) {
                $this->deleteImage($new, 'img');
                $new->delete();
            }
            toastr()->success('لقد تم الالغاء بنجاح');
        }
        return redirect()->back();
    }


}
