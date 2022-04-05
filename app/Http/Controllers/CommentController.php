<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validationData = $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment->content = $validationData['content'];
        $comment->user_id = Auth::user()->getAuthIdentifier();
        $comment->post_id = $comment->post()->id;
        $comment->save();

        session()->flash('message', 'Comment was updated');
        return redirect()->route('posts.show',['post' => $comment->post()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        // session()->flash('message', 'Post was deleted');
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
