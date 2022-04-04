<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

//Post routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::get('/example', [PostController::class,'example']);

Route::get('/profile',[ProfileController::class, 'index'])->name('profile.index');

Route::middleware(['auth'])->group(function(){
    Route::view('/admin','admin')->name('admin');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
