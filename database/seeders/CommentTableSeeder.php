<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = new Comment();
        $c->content = "This cat is so cute!";
        $c->user_id = 1;
        $c->post_id = 1;
        $c->save();

        Comment::factory()->count(50)->create();
    }
}
