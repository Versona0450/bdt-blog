<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $guest = User::where('role_id', 4);
        if (Gate::allows('isGuest', $guest )) {
            return redirect(route('blog'));
        }

        $article = Article::all()->count('id');
        $writer = User::all()->where('role_id', 2)->count('id');
        $publisher = User::all()->where('role_id', 3)->count('id');
        $guest = User::all()->where('role_id', 4)->count('id');

        return view('admin.dashboard', compact('article', 'writer', 'publisher', 'guest'));
    }
  


}
