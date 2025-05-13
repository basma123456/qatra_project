<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use FileHandler;

    protected $user;

    public function __construct(Admin $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Admin::role('Admin');
        if ($request->name != '') {
            $query = $query->where('name', 'like','%' . request()->input('name') . '%');
        }
        if ($request->mobile != '') {

            $query = $query->where('mobile', 'like','%' . request()->input('mobile') . '%');
        }
        if ($request->email != '') {
            $query = $query->where('email', 'like','%' . request()->input('email') . '%');
        }


        $users = $query->latest()->paginate($this->pagination_count);

//        $users = ->paginate($this->admin_pagination_count);
        return view("admin.admins.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.admins.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'email|nullable|unique:admins,email',
            'mobile' => 'required|digits:12|starts_with:966|unique:admins,mobile',
            'password' => 'required|alpha_num|min:8',
            'image' => 'nullable|image',
        ]);
        $row = $request->all();
        if ($request->hasFile('image')) {
            $row['image'] = $this->storeImage2($request, $this->user->path('admins'), $request->image, 'image');
        }
        $row['password'] = Hash::make($request->password);
        $user = Admin::create($row);
        $user->assignRole('Admin');
        toastr()->success('لقد تم التسجيل بنجاح');
        return redirect()->route("admin.admins.index");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Admin $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::role('Admin')->find($id);
        if (!$admin) {
            toastr()->error("لا يوجد بيانات");
            return redirect()->route('admin.admin.index');
        }
        return view("admin.admins.show", compact("admin"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Admin $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::role('Admin')->find($id);
        if (!$admin) {
            toastr()->error("لا يوجد بيانات");
            return redirect()->route('admin.admin.index');
        }
        return view("admin.admins.edit", compact("admin"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Admin $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::role('Admin')->find($id);
        $request->validate([
            'name' => 'required',

            'email' => 'nullable|email|unique:admins,email,' . $admin->id,
            'mobile' => 'required|digits:12|starts_with:966|unique:admins,mobile,' . $admin->id,
            'password' => 'nullable|alpha_num|min:8',
            'image' => 'nullable|image',
        ]);

        $row = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];
        if ($request->hasFile('image')) {
            $row['image'] = $this->updateImage($request, $admin, $admin->path('admins'), $request->image, 'image');

        }


        if ($request->filled('password')) {
            $row['password'] = Hash::make($request->password);
        }
        $admin->update($row);
        toastr()->success('لقد تم التعديل بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Admin $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $user = Admin::role('Admin')->find($id);
        $this->deleteAdminImage($user, 'image' , 'admins');
        $user->delete();
        toastr()->success('لقد تم الالغاء بنجاح');

        return redirect()->route("admin.admins.index");
    }




    public function actions(Request $request)
    {
        if ($request['delete_all'] == 1) {
            $users = Admin::role('Admin')->findMany($request['record']);
            foreach ($users as $new) {
                $this->deleteAdminImage($new , 'image' , 'admins');
                $new->delete();
            }
            toastr()->success('لقد تم الالغاء بنجاح');
        }
        return redirect()->back();
    }


}
