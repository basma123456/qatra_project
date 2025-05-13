<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminsRequest;
use App\Traits\FileHandler;

 class AdminsController extends Controller
{
    use FileHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $query = Admin::query()->with('roles')->orderBy('id','ASC');

        if($request->status  != ''){
            $query->where('status', $request->status );
        }
        if($request->name  != ''){
            $query->where('name','like','%'. $request->name .'%');
        }
        if($request->email  != ''){
            $query->where('email','like','%'. $request->email .'%');
        }
        if($request->mobile  != ''){
            $query->where('mobile','like','%'. $request->mobile .'%');
        }

        // $user->roles
        if($request->role  != ""){
            $rolesId = $request->role;
            $query->whereHas('roles', function($q) use ($rolesId){
                $q->where('id', $rolesId);
            });

        }

        $users = $query->paginate($this->pagination_count);


        return view('admin.admin.index',compact('users','roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::query()->select(['name'])->get();
        return view('admin.admin.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminsRequest $request)
    {
        $data =$request->getSanitized();
        if($request->hasFile('image')){
            $data['image'] = $this->upload_file($request->file('image') , ('admin'));
        }
        $data['password'] = bcrypt($data['password']);

        $admin = Admin::create($data);
        $admin->assignRole($data['roles']);

        session()->flash('success' , trans('message.admin.created_sucessfully') );
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin  $admin)
    {
        $roles = Role::query()->select(['name'])->get();
        return view('admin.admin.edit',compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminsRequest $request, Admin $admin)
    {
        $data = $request->getSanitized();

        $data['password'] = $data['password']? bcrypt($data['password']) : $admin->password;
        if($request->hasFile('image')){
            $data['image'] = $this->upload_file($request->file('image') , ('admin'));
        }
        $admin->update($data);
        $admin->syncRoles($data['roles']);
        session()->flash('success' , trans('message.admin.updated_sucessfully') );
        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        @unlink($admin->image);
        $admin->delete();
        session()->flash('success' , trans('message.admin.deleted_sucessfully') );
        return redirect()->back();
    }



    public function update_status($id){
        $admin = Admin::findOrfail($id);
        $admin->status == 1 ? $admin->status = 0 : $admin->status = 1;
        $admin->save();
        return redirect()->back();
    }

    public function actions(Request $request){
        if($request['publish'] == 1 ){
            $admins = Admin::findMany($request['record']);
            foreach ($admins as $admin){
                $admin->update(['status' => 1]);
            }
            session()->flash('success' , trans('message.admin.status_changed_sucessfully') );
        }
        if($request['unpublish'] == 1 ){
            $admins = Admin::findMany($request['record']);
            foreach ($admins as $admin){
                $admin->update(['status' => 0]);
            }
            session()->flash('success' , trans('message.admin.status_changed_sucessfully') );
        }
        if($request['delete_all'] == 1 ){
            $admins = Admin::findMany($request['record']);
            foreach ($admins as $admin){
                @unlink($admin->image);
                $admin->delete();
            }
            session()->flash('success' , trans('message.admin.delete_all_sucessfully') );
        }
        return redirect()->back();
    }
}


