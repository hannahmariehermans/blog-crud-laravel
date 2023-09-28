<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blog/{article}', [App\Http\Controllers\HomeController::class, 'show']);

route::group(['prefix' => 'admin', 'as' => 'admin.'], function()
{
    Route::get('/', [App\Http\Controllers\ArticleController::class, 'admin'])->name('admin');
    Route::get('create', [App\Http\Controllers\ArticleController::class, 'create'])->name('create'); //shows create post form
    Route::post('store', [App\Http\Controllers\ArticleController::class, 'store'])->name('create.store');

    route::group(['prefix' => 'article', 'as' => 'article.'], function()
    {
        Route::get('edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('edit.update');
        Route::get('delete/{id}', [App\Http\Controllers\ArticleController::class, 'delete'])->name('delete');
    });
});*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blog/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('blog.post');

Route::post('/blog/{id}/comments',[App\Http\Controllers\CommentController::class,'store'])->name('blog.comment');
Route::get('/comments/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');

Route::post('/blog/{article:id}/like', [App\Http\Controllers\PostLikeController::class, 'store'])->name('blog.like');
Route::get('/like/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('like.delete');



Route::get('admin', [App\Http\Controllers\ArticleController::class, 'admin'])->name('admin');
Route::get('admin/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('admin.create'); //shows create post form
Route::post('admin/store', [App\Http\Controllers\ArticleController::class, 'store'])->name('admin.create.store');


Route::get('admin/article/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('admin.article.edit');
Route::post('admin/article/edit/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('admin.article.edit.update');
Route::get('admin/article/delete/{id}', [App\Http\Controllers\ArticleController::class, 'delete'])->name('admin.article.delete');



