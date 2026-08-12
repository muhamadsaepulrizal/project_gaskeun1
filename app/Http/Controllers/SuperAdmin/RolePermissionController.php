<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        
        return view('superadmin.roles.index', compact('roles', 'permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:roles']);
        
        $role = Role::create(['name' => $request->name]);
        activity()->performedOn($role)->log('Created role');
        
        return redirect()->back()->with('success', 'Role berhasil dibuat.');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:permissions']);
        
        $permission = Permission::create(['name' => $request->name]);
        activity()->performedOn($permission)->log('Created permission');
        
        return redirect()->back()->with('success', 'Permission berhasil dibuat.');
    }

    public function assignPermission(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role->syncPermissions($request->permissions ?? []);
        activity()->performedOn($role)->log('Updated role permissions');

        return redirect()->back()->with('success', 'Permission berhasil diatur.');
    }
}
