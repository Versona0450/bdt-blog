<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tag = Tag::OrderBy('name')->get();
        $admin = User::where('role_id', 1);

        if (!Gate::allows('isAdmin', $admin )) {
            return abort(404);
        }
        return view('admin.tag.index', compact('tag'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $tag = Tag::create([
            'name' => $request->name
        ]);
        return redirect()->back()->with(['success' => 'New Tag']);
    }

 
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit', compact('tag'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $tag = Tag::find($id);
        $tag->update([
            'name' => $request->name
        ]);
        return redirect(route('tag.index'))->with(['success' => 'Tag has been updated']);
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->back();
    }
}
