<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    public function _construct(Permission $permission)
    {
        $this->permission = $permission;
        // $this->middleware("auth");
    }
    
    public function index()
    {
        $permission = Permission::latest()->get();
        return view('admin.permission.index',['permission' => $permission]);
        // dd($permission);
    }

    public function create(Request $request)
    {
        $permission = Permission::all();
        return view('admin.permission.create',['permission' => $permission]);
    }

    public function store(Request $request)
    {
        Permission::create($request->all());

        Alert::success('Success', 'Permission Saved Successfully !');
        return redirect()->route('admin.permission.index');
    }
    
    public function getAllPermissions()
    {
        $permission = Permission::all();
        return response()->json([
            'permissions' => $permissions
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $permission = Permission::all();
        $permission = Permission::find($id);
        return view('admin.permission.edit',['permission' => $permission]);
    }

    public function delete($id)
    {
        Permission::find($id)->delete();

        Alert::error('Deleted', 'Permission Deleted Successfully !');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        $permission -> update($request->all());

        Alert::warning('Updated', 'Permission Updated Successfully !');
        return redirect()->route('admin.permission.index');
    }
}
