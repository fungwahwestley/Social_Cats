<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function example(Post $foo){
        dd($foo);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationData = $request->validate([
            'caption' => 'required|max:255',
            'image_filepath' => 'nullable|max:500',
        ]);

        $p = new Post;
        $p->caption = $validationData['caption'];
        $p->image_filepath = $validationData['image_filepath'];
        $p->user_id = Auth::user()->getAuthIdentifier();
        $p->save();

        session()->flash('message', 'Post was created');
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->get();
        return view('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validationData = $request->validate([
            'caption' => 'required|max:255',
            'image_filepath' => 'nullable|max:500',
        ]);

        $post->caption = $validationData['caption'];
        $post->image_filepath = $validationData['image_filepath'];
        $post->user_id = Auth::user()->getAuthIdentifier();
        $post->save();

        session()->flash('message', 'Post was updated');
        return redirect()->route('posts.show',['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $post->delete();
        // session()->flash('message', 'Post was deleted');
        return redirect()->route('posts.index')->with('message','Post was deleted');
    }


}
