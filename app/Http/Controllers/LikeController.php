<?php

namespace App\Http\Controllers;

use App\Mail\UserLikedComment;
use App\Mail\UserLikedPost;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;


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

            Mail::to($post->user()->get())->send(new UserLikedPost($l));

            session()->flash('message', 'Post was liked');
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

            Mail::to($comment->user()->get())->send(new UserLikedComment($l));

            session()->flash('message', 'Comment was liked');
        }

        return redirect()->back();
    }

}
