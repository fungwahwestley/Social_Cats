<?php

namespace App\Http\Controllers;

use App\Mail\UserCommented;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\Response;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function page(Post $post){
        return view('posts.show-api', ['post'=>$post]);
    }

    public function apiIndex(Post $post)
    {
        return $post->comments()->get();
    }

    public function apiStore(Request $request, Post $post){
        $validationData = $request->validate([
            'content' => 'required|max:255',
        ]);

        $c = new Comment;
        $c->content = $validationData['content'];
        $c->user_id = 11;
        $c->post_id = $post->id;
        $c->save();


        return Comment::with('user')->findOrFail($c->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment, Post $post)
    {
        return view('comments.show', ['comment' => $comment, 'post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment, Post $post)
    {
        if (!(Gate::allows('update-comment', $comment) || Gate::allows('update-comment-admin'))) {
            abort(403);
        }
        return view(route('posts.show',['post'=>$post]));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment, Post $post)
    {

        if (!(Gate::allows('update-comment', $comment) || Gate::allows('update-comment-admin'))) {
            abort(403);
        }
        $validationData = $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment->content = $validationData['content'];
        $comment->user_id = Auth::user()->getAuthIdentifier();
        $comment->post_id = $comment->post_id;
        $comment->save();

        session()->flash('message', 'Comment was updated');
        return redirect()->route('posts.show',['post'=>$comment->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, Post $post)
    {
        if (!(Gate::allows('delete-comment', $comment) || Gate::allows('delete-comment-admin'))) {
            abort(403);
        }
        $comment->delete();
        return redirect()->route('posts.index')->with('message', 'Comment was deleted');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $validationData = $request->validate([
            'content' => 'required|max:255',
        ]);

        $c = new Comment;
        $c->content = $validationData['content'];
        $c->user_id = $request->user_id;
        $c->post_id = $post->id;
        $c->save();

        Mail::to($post->user()->get())->send(new UserCommented($c));

        session()->flash('message', 'Comment was created');
        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function abort(){
        abort(403);
    }
}
