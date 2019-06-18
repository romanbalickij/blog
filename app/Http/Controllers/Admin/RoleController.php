<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.role_index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.role_create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permission);
        return redirect()->back();
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $role->load('permissions');
        $permissions = Permission::all();
        return view('admin.role.role_edit', compact('role', 'permissions'));

    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name =  $request->name;
        $role->label = $request->label;
        $role->save();
        $role->permissions()->sync($request->permission);
        return redirect()->back();

    }
}
