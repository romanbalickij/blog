<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Models;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions  = Permission::all();
        return view('admin.role.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        Permission::create($request->all());
        return redirect()->back();
    }
}
