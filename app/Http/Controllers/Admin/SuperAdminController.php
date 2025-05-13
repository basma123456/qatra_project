<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileHandler;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    use FileHandler;

    protected $user;

    public function __construct(User $user)
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
        $query = User::role('Super-Admin');
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
        return view("admin.super_admins.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.super_admins.create");
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
            'email' => 'email|nullable|unique:users,email',
            'mobile' => 'required|digits:12|starts_with:966|unique:users,mobile',
            'password' => 'required|alpha_num|min:8',
            'image' => 'nullable|image',
        ]);
        $row = $request->all();
        if ($request->hasFile('image')) {
            $row['image'] = $this->storeImage2($request, $this->user->path('super_admins'), $request->image, 'image');
        }
        $row['password'] = Hash::make($request->password);
        $user = User::create($row);
        $user->assignRole('Super-Admin');
        toastr()->success('لقد تم التسجيل بنجاح');
        return redirect()->route("admin.super_admins.index");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $super_admin = User::role('Super-Admin')->find($id);
        return view("admin.super_admins.show", compact("super_admin"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $super_admin = User::role('Super-Admin')->find($id);
        if (!$super_admin) {
            toastr()->error("لا يوجد بيانات");
            return redirect()->route('admin.super_admin.index');
        }
        return view("admin.super_admins.edit", compact("super_admin"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $super_admin = User::role('Super-Admin')->find($id);
        $request->validate([
            'name' => 'required',

            'email' => 'nullable|email|unique:users,email,' . $super_admin->id,
            'mobile' => 'required|digits:12|starts_with:966|unique:users,mobile,' . $super_admin->id,
            'password' => 'nullable|alpha_num|min:8',
            'image' => 'nullable|image',
        ]);

        $row = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];
        if ($request->hasFile('image')) {
            $row['image'] = $this->updateImage($request, $super_admin, $super_admin->path('super_admins'), $request->image, 'image');

        }


        if ($request->filled('password')) {
            $row['password'] = Hash::make($request->password);
        }
        $super_admin->update($row);
        toastr()->success('لقد تم التعديل بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(  $id)
    {
        $user = User::role('Super-Admin')->find($id);
        $this->deleteUserImage($user, 'image' , 'super_admins');
        $user->delete();
        toastr()->success('لقد تم الالغاء بنجاح');

        return redirect()->route("admin.super_admins.index");
    }




    public function actions(Request $request)
    {
        if ($request['delete_all'] == 1) {
            $products = User::role('Super-Admin')->findMany($request['record']);
            foreach ($products as $new) {
                $this->deleteUserImage($new , 'image' , 'super_admins');
                $new->delete();
            }
           toastr()->success('لقد تم الالغاء بنجاح');
        }
        return redirect()->back();
    }

}
