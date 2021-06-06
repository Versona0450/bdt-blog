<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $this->authorize('View Article');
        
        $article = Article::orderByDesc('created_at')->paginate(10);
        return view('admin.article.index', compact('article'));
    }

   
    public function create()
    {
        $this->authorize('Create Article');

        $tag = Tag::all();
        $category = Category::all();
        return view('admin.article.create', compact('tag', 'category'));
    }

    public function store(Request $request)
    {
        $this->authorize('Create Article');

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->thumbnail;
            $filename = time(). Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension();

            $article = Article::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
                'content' => $request->content,
                'thumbnail' => $filename,
            ]);

            $article->tags()->attach($request->tags);
            $thumbnail->move('articles/posts/', $filename);

            return redirect(route('article.index'))->with(['success' => 'New Article has been Create']);
        }
        
    }


    public function edit($id)
    {
        $this->authorize('Edit Article');

        $article = Article::find($id);
        $category = Category::all();
        $tag = Tag::all();
        return view('admin.article.edit', compact('article', 'category', 'tag'));
    }


    public function update(Request $request, $id)
    {
        $this->authorize('Update Article');
        
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $article = Article::find($id);
        $filename = $article->thumbnail;
        
        if ($request->hasFile('image')) {
            unlink(public_path('articles/posts/' . $article->thumbnail));
            $file = $request->file('image');
            $filename = time() . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->move('articles/posts/', $filename);
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'thumbnail' => $filename
        ]);
        
        $article->tags()->sync($request->tags);
        return redirect(route('article.index'))->with(['success' => 'Article Diperbaharui']);
        
    }

    public function destroy($id)
    {
        $this->authorize('Delete Article');

        $article = Article::find($id);
        unlink(public_path('articles/posts/' . $article->thumbnail));
        
        $article_tag = ArticleTag::where('article_id', $id)->delete();
        $article->delete();
        return redirect(route('article.index'))->with(['success' => 'Article Berhasil di hapus']);
    }

    public function publish($id)
    {
        $this->authorize('Publish Article');

        $article = Article::find($id);
        $article->update([
            'status' => 1,
        ]);
        return redirect(route('article.index'));
    }

    public function cancel($id)
    {
        $this->authorize('Publish Article');

        $article = Article::find($id);
        $article->update([
            'status' => 0,
        ]);
        return redirect(route('article.index'));
    }


}
