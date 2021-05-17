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

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        
        return view('admin.user.edit',['user' => $user],['roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $roles_name = $user->getRoleNames();

            $data = $request->all();
            // dd($data);
            $role = Role::findById($data['role']);
            // dd($role);

            if ($roles_name == true) {
                $user->removeRole($roles_name[0]);
                $user -> update($request->all());
            }
            $user->assignRole($role);
            

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
