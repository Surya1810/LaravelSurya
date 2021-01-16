<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $data_users = User::all();
        $roles =Role::all();
        return view('admin.user.index',compact('data_users','roles'));
    }
    
    // public function roles(Request $request)
    // {
    //     $roles = \Spatie\Permission\Models\Role::all();
    //     return view('crud.index',['roles' => $roles]);
    // }

    public function create(Request $request)
    {
        return view('admin.user.create');
    }

    public function store(array $data)
    {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required|unique:users|max:255',
            'phone' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        $user->assignRole('guest');

        Alert::success('Success', 'User Created Successfully !');
        return redirect()->route('admin.user.index');
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        
        return view('admin.user.edit',['user' => $user],['roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user -> update($request->all());

        Alert::warning('Updated','User Updated Successfully !');
        return redirect()->route('admin.user.index');
    }

    public function delete($id)
    {
        User::find($id)->delete();

        Alert::error('Deleted','User Deleted Successfully !');
        return redirect()->back();
    }
    
    public function _construct(Role $role)
    {
        $this->middleware('auth');
        $this->role = $role;
    }
}
