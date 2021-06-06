<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// INDEX
Route::get('/', [HomeController::class, 'blog'])->name('blog');
// SEARCH CATEGORY -COMING SOON

// SEARCH TAG - COMING SOON

// SEARCH QUERY
Route::get('/article/s', [HomeController::class, 'search'])->name('blog.search');

// DETAIL BLOG
Route::get('/article/{id}', [HomeController::class, 'show'])->name('blog.show');

    Auth::routes();

    // GUEST COMMENT
    Route::post('/article/comment/{id}', [HomeController::class, 'comment'])->name('article.comment');

    // ADMIN SIDE
    Route::prefix('admin')->group(function (){

        // ADMIN SIDE - DASHBOARD
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        // ADMIN SIDE - ARTICLE
        Route::resource('/article', ArticleController::class)->except('show');
        Route::put('/article/{id}/publish}', [ArticleController::class, 'publish'])->name('article.publish');
        Route::put('/article/{id}/cancel}', [ArticleController::class, 'cancel'])->name('article.cancel');
    
        // ADMIN SIDE - ROLE,CATGORY,TAG,USER
        Route::resource('/role', RoleController::class);
        Route::resource('/category', CategoryController::class);
        Route::resource('/tag', TagController::class);
        Route::resource('/user', UserController::class)->except('create', 'store', 'show');
    
        // ADMIN SIDE - COMMENT
        Route::resource('/comment', CommentController::class)->except('show', 'edit', 'update', 'destroy');
        Route::put('/comment/{id}/publish', [HomeController::class, 'publish'])->name('comment.publish');
        Route::delete('/comment/{id}/destroy', [HomeController::class, 'destroy'])->name('comment.destroy');
    
    });
   