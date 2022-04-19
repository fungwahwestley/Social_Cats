<?php

namespace App\Mail;

use App\Models\Like;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserLikedPost extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userWhoLiked = null;
        $users = User::all();
        foreach ($users as $user) {
            if ($user->id == $this->like->user_id) {
                $userWhoLiked = $user;
            }
        }


        return $this->from('notifications@catagram.com', 'Catagram Team')
            ->markdown('mail.user-liked-posts', ['user' => $userWhoLiked]);
    }
}
