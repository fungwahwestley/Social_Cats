<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/example', [PostController::class, 'example']);

Route::middleware(['auth'])->group(function () {
    Route::view('/admin', 'admin')->name('admin');


    //generate token route
    Route::get('/token',[AuthenticatedSessionController::class, 'generateToken'])->name('auth.create.token');

    //Post routes
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
  //Route::get('/posts/{post}', [CommentController::class, 'page'])->name('posts-api.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    //like routes
    Route::post('/posts/{post}/like', [LikeController::class, 'postStore'])->name('likes-post.store');
 //   Route::delete('/posts/{post}/like', [LikeController::class, 'postDestroy'])->name('likes-post.destroy');
    Route::post('/comments/{comment}/like', [LikeController::class, 'commentStore'])->name('likes-comment.store');
   // Route::delete('/comments/{comment}/like', [LikeController::class, 'commentDestroy'])->name('likes-comment.destroy');


    //comment routes
    //Route::get('/posts/{post}', [CommentController::class, 'page'])->name('posts-api.show');
    Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::get('/abort',[CommentController::class,'abort'])->name('comments.abort');

    //profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');


});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
