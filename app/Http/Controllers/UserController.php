<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {
        $admin = User::where('role_id', 1);
        $user = User::all()->whereNotInStrict('role_id', 4);
        $guest = User::all()->where('role_id', 4);
        $role = Role::all();

        if (Gate::allows('isAdmin', $admin )) {
            return view('admin.user.index', compact('user', 'guest', 'role'));
        }
            return abort(404);

        
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required',
            'password' => 'required|string|max:50',
            'role_id' => 'required'
        ]);
            
        $role = Role::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        return redirect(route('user.index'))->with(['successs' => 'Create New User Success']);
    }


    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();

        return view('admin.user.edit', compact('user', 'role'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'role_id' => $request->role_id,
        ]);
        
        return redirect(route('user.index'))->with(['success' => 'Role Diperbaharui']);
        
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with(['success' => 'User Dihapus']);
    }

}
