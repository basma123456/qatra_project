<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MenuPositionEnums;
use App\Models\Menue;
use App\Models\Pages;
use App\Enums\UrlTypesEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class MenueController extends Controller
{

    public function index()
    {
        return view('livewire.admin.menus.index');
    }

    public function create()
    {
        return view('admin.dashboard.menus.create');
    }

    public function getMenus(Request $request)
    {

        $query = Menue::query();
        $ids = $this->arrang_records($query->get());

        if ($request->position == MenuPositionEnums::MAIN) {
            if ($ids) $menus = $query->whereIn('id', $ids)->main()->orderByRaw("field(id," . implode(',', $ids) . ")")->get();
            else $menus = $query->get();
        } elseif ($request->position == MenuPositionEnums::FOOTER) {
            if ($ids) $menus = $query->whereIn('id', $ids)->footer()->orderByRaw("field(id," . implode(',', $ids) . ")")->get();
            else $menus = $query->get();
        }

        foreach ($menus as $menu) {
            $menu->name = $menu->title;
        }
        return $menus;
    }

    public function createMenu($id)
    {
        $item_parent_id = $id;
        $createMode = true;
        $items =  collect(Menue::query()->main()->get());
        return view('admin.dashboard.menus.index', compact('items', 'item_parent_id', 'createMode'));
    }


    public function store(MenuRequest $request)
    {
        Cache::forget('menus');
        Cache::forget('footer-menus');

        $data = $request->getSanitized();
        Menue::create($data);
        session()->flash('success', trans('message.admin.created_sucessfully'));
        return redirect()->route('admin.menus.create');
    }

    public function show(Menue $menu)
    {
        return view('admin.dashboard.menus.show', compact('menu'));
    }


    public function edit(Menue $menu)
    {
        Cache::forget('menus');
        Cache::forget('footer-menus');
        $item = $menu;
        if ($menu->position == MenuPositionEnums::FOOTER) {
            $menus = Menue::query()->footer()->get();
        } else {
            $menus = Menue::query()->main()->get();
        }
        $childs =  $this->get_childs_id($item->children,  $menus);
        $ids = $this->arrang_records($menus);
        if ($ids) $menus = Menue::query()->whereIn('id', $ids)->whereNotIn('id', $childs)->where('id', '!=',  $item->id)->orderByRaw("field(id," . implode(',', $ids) . ")")->get();

        return view('admin.dashboard.menus.edit', compact('menu', 'menus'));
    }

    public function update(MenuRequest $request, Menue $menu)
    {
        Cache::forget('menus');
        Cache::forget('footer-menus');

        $data = $request->getSanitized();
        $menu->update($data);
        $query = Menue::query()->get();
        $this->update_childs_level($menu,  $query);
        session()->flash('success', trans('message.admin.updated_sucessfully'));
        return redirect()->back();
    }


    public function destroy(Menue $menu)
    {
        Cache::forget('menus');
        Cache::forget('footer-menus');

        $menu->delete();
        session()->flash('success', trans('message.admin.deleted_sucessfully'));
        return redirect()->route('admin.menus.index');
    }

    public function update_status($id)
    {
        Cache::forget('menus');
        Cache::forget('footer-menus');

        $menu = Menue::findOrfail($id);
        $menu->status == 1 ? $menu->status = 0 : $menu->status = 1;
        $menu->save();
        return redirect()->back();
    }


    public function actions(Request $request)
    {
        Cache::forget('menus');
        Cache::forget('footer-menus');

        if ($request['publish'] == 1) {
            $menus = Menue::findMany($request['record']);
            foreach ($menus as $menu) {
                $menu->update(['status' => 1]);
            }
            session()->flash('success', trans('pages.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $menus = Menue::findMany($request['record']);
            foreach ($menus as $menu) {
                $menu->update(['status' => 0]);
            }
            session()->flash('success', trans('pages.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $menus = Menue::findMany($request['record']);
            foreach ($menus as $menu) {

                $menu->delete();
            }
            session()->flash('success', trans('pages.delete_all_sucessfully'));
        }
        return redirect()->back();
    }


    public function show_tree(Request $request)
    {
        if ($request->position == MenuPositionEnums::FOOTER) {
            $items =  Menue::query()->footer()->get();
        } else {
            $items =  Menue::query()->main()->get();
        }
        $searchItem = [];
        if ($request->title) {
            $searchItem = Menue::query()->main()->where('title', '%' . $request->title . '%')->get();
        }
        return view('admin.dashboard.menus.index', compact('items', 'searchItem'));
    }


    public function getUrl(Request $request)
    {
        $name = $request->name;

        $res = [];
        if ($name == UrlTypesEnum::PAGES) {
            $items = Pages::active()->get();
            foreach ($items as $item) {
                $res[] =  '/pages/' . $item->slug;
            }
        }

        if ($name == UrlTypesEnum::PRODUCTS) {
            $items = Product::active()->get();
            foreach ($items as $item) {
                $res[] =  '/products/' . $item->slug;
            }
        }

        if ($name == UrlTypesEnum::CATEGORY) {
            $items = Category::active()->get();
            foreach ($items as $item) {
                $res[] =  '/products?category=' . $item->slug;
            }
        }

        return $res;
    }



    public function arrange_child($parent, &$ids, $items = null)
    {
        $children =  $items->where('parent_id', $parent->id);
        foreach ($children as $item) {
            $ids[] = $item->id;
            $this->arrange_child($item, $ids, $items);
        }
    }


    public function get_childs_id($items,  $tree)
    {
        $ids = [];
        foreach ($items as $item) {
            $ids[] = $item->id;
            $this->arrange_child($item, $ids, $tree);
        }
        return $ids;
    }

    public function arrang_records($items, $search_ids = [])
    {
        $ids = [];
        if ($search_ids != []) $parents = $items->whereIn('id', $search_ids);
        else $parents = $items->where('parent_id', null);
        foreach ($parents as $item) {
            $ids[] = $item->id;
            $this->arrange_child($item, $ids, $items);
        }
        return $ids;
    }

    public function update_childs_level($parent, $items = null)
    {
        $childsModel = [];
        $this->get_childs($parent, $childsModel,  $items);
        if ($childsModel) {
            foreach ($childsModel as $childupdate) {
                if (isset($childupdate->level)) {
                    $childupdate->level =  $this->updateLevel(@$childupdate->parent);
                    $childupdate->save();
                }
            }
        }

        return $childsModel;
    }

    public function updateLevel($parent)
    {
        if ($parent == null) {
            return 1;
        } else {
            return $parent->level + 1;
        }
    }

    public function get_childs($parent, &$childsModel,  $items = null)
    {
        foreach ($parent->children as $item) {
            $childsModel[] = $item;
            $this->arrange_child($item, $childsModel,  $items);
        }
    }
}
