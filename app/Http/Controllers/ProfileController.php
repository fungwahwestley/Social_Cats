<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $posts = Post::all()->where('user_id',Auth::user()->getAuthIdentifier());
      //  $comments = Comment::all()->where('user_id',Auth::user()->getAuthIdentifier());
        $user = Auth::user();
        return view('profile.index', ['user' => $user]);
    }


}
