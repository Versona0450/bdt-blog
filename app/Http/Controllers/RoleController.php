<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $admin = User::where('role_id', 1);

        if (!Gate::allows('isAdmin', $admin )) {
            return abort(404);
        }
        
        $role = Role::all();
        $permission = Permission::all();
        return view('admin.role.index', compact('role', 'permission'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);
        
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->permissions()->attach($request->permissions);
        return redirect(route('role.index'))->with(['success' => 'Success add new role']);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);
        return redirect(route('role.index'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        $permission = PermissionRole::where('role_id', $id)->delete();
        $role->delete();
        return redirect(route('role.index'))->with(['success' => 'Role has been Deleted']);
    }

    

}
