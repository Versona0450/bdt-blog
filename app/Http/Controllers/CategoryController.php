<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $category = Category::OrderBy('name')->get();

        $admin = User::where('role_id', 1);
        if (!Gate::allows('isAdmin', $admin )) {
            return abort(404);
        }
        return view('admin.category.index', compact('category'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = Category::create([
            'name' => $request->name
        ]);
        return redirect()->back()->with(['success' => 'New Category']);
    }

 
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $category = Category::find($id);
        $category->update([
            'name' => $request->name
        ]);
        return redirect(route('category.index'));
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }
}
