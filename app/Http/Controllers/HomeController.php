<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\CommentArticle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{

    public function blog()
    {
        $first = Article::latest()->take(1)->get();
        $article = Article::orderByDesc('created_at')->where('status', 1)->paginate(10);

        return view('welcome', compact('first', 'article'));

    }

    public function search(Request $request)
    {
        $search = $request->search;
        $article = Article::where('title','like',"%".$search."%")->where('status', 1)->paginate(5);
        return view('welcome',compact('article'));
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
  
    public function show($id)
    {
        $article = Article::find($id);
        if($article->status == 1){
            return view('blog.detail', compact('article'));   
        }else
        // JIKA STATUS DRAFT DAN TIDAK PUNYA AKSES
        if ($article->status == 0 && !$this->authorize('View Article')) {
            abort(404);
        // JIKA STATUS DRAFT DAN PUNYA AKSES
        } else if($article->status == 0 && $this->authorize('View Article')){
            return view('blog.detail', compact('article'));
        // JIKA STATUS PUBLISH DAN TIDAK PUNYA AKSES
        }
        
    }

    public function comment(Request $request, $id)
    {   
        $article = Article::find($id);
        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'article_id' => $article->id,
        ]);
        $comment->article()->attach($id);
        return redirect()->back()->with(['draft' => 'Komentar Anda Sedang di Tinjau, Jika Sudah Sesuai Dengan Ketentuan Kami, Komentar Anda Akan Di Publish']);
    }

    public function publish($id)
    {
        $comment = Comment::find($id);
        $comment->update([
            'status' => 1,
        ]);
        return redirect()->back()->with(['success' => 'Komentar Telah di Publish']);
    }
    
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $commentArticle = CommentArticle::where('comment_id', $id)->delete();
        $comment->delete();
        
        return redirect()->back()->with(['success' => 'Comment has been Deleted']);
    }



}
