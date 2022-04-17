<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class LikeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function postStore(Post $post)
    {
        $existing_like = false;

        $likes = Like::all();
        foreach ($likes as $like) {
            if ($like->likeable_id == $post->id) {
                if ($like->user_id == Auth::user()->getAuthIdentifier()) {
                    if ($like->likeable_type == 'Post::class') {
                        $existing_like = true;
                    }
                }
            }
        }

        if (!$existing_like) {
            $l = new Like;
            $l->user_id = Auth::user()->getAuthIdentifier();
            $l->likeable_id = $post->id;
            $l->likeable_type = Post::class;
            $l->save();

            session()->flash('message', 'Post was liked');
        } else {
            session()->flash('message', 'Post already liked');
        }

        return redirect()->back();
    }

    public function commentStore(Comment $comment)
    {
        $existing_like = false;

        $likes = Like::all();
        foreach ($likes as $like) {
            if ($like->likeable_id == $comment->id) {
                if ($like->user_id == Auth::user()->getAuthIdentifier()) {
                    if ($like->likeable_type == 'Comment::class') {
                        $existing_like = true;
                    }
                }
            }
        }

        if (!$existing_like) {
            $l = new Like;
            $l->user_id = Auth::user()->getAuthIdentifier();
            $l->likeable_id = $comment->id;
            $l->likeable_type = Comment::class;
            $l->save();

            session()->flash('message', 'Comment was liked');
        } else {
            session()->flash('message', 'Comment already liked');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function postDestroy(Post $post)
    {

        $likes = Like::all();
        foreach ($likes as $like) {
            if ($like->likeable_id == $post->id && $like->user_id == Auth::user()->getAuthIdentifier() && $like->likeable_type == 'Post::class') {
                $like->delete();
                session()->flash('message', 'Like was removed');

            }else{
                session()->flash('message', 'Post not liked!');
            }
        }


        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $post
     * @return \Illuminate\Http\Response
     */
    public function commentDestory(Comment $comment)
    {

        $likes = Like::all();
        foreach ($likes as $like) {
            if ($like->likeable_id == $comment->id && $like->user_id == Auth::user()->getAuthIdentifier() && $like->likeable_type == 'Comment::class') {
                $like->delete();
                session()->flash('message', 'Like was removed');

            }else{
                session()->flash('message', 'Post not liked!');
            }
        }


        return redirect()->back();

    }

}
