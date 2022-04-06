<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment, Post $post)
    {
        return view('comments.show', ['comment' => $comment, 'post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment, Post $post)
    {
        return view('comments.edit', ['comment' => $comment, 'post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment, Post $post)
    {
        $validationData = $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment->content = $validationData['content'];
        $comment->user_id = Auth::user()->getAuthIdentifier();
        $comment->post_id = $comment->post_id;
        $comment->save();

        session()->flash('message', 'Comment was updated');
        return redirect()->route('comments.show',['comment'=>$comment, 'post'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, Post $post)
    {
        $comment->delete();

        return redirect()->route('posts.index')->with('message','Comment was deleted');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $validationData = $request->validate([
            'content' => 'required|max:255',
        ]);

        $c = new Comment;
        $c->content = $validationData['content'];
        $c->user_id = Auth::user()->getAuthIdentifier();
        $c->post_id = $post->id;
        $c->save();

        session()->flash('message', 'Comment was created');
        return redirect()->route('posts.show', ['post'=>$post]);
    }
}
