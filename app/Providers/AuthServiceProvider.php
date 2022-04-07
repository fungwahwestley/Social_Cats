<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Providers\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Users can only edit and delete their own posts
        Gate::define('update-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;

        });

        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;

        });

        Gate::define('update-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;

        });
        Gate::define('delete-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;

        });

        //Auth can edit and delete all posts
        Gate::define('update-post-admin', function (User $user) {
            return $user->admin === 1;

        });

        Gate::define('delete-post-admin', function (User $user) {
            return $user->admin === 1;

        });

        Gate::define('update-comment-admin', function (User $user) {
            return $user->admin === 1;

        });
        Gate::define('delete-comment-admin', function (User $user) {
            return $user->admin === 1;

        });

    }
}
