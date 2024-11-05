<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        // Fetch all roles and permissions
        $roles = Role::all();
        $permissions = Permission::all();

        return view('permissions.index', compact('roles', 'permissions'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Find the role
        $role = Role::findByName($request->role);

        // Sync the permissions to the role
        $role->syncPermissions($request->permissions);

        return redirect()->route('permissions.index')->with('success', 'Permissions assigned successfully.');
    }
}
