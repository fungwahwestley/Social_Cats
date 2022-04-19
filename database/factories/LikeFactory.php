<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Integer;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $likeable_type = "";
        $likeable_id = 0;
        $type = $this->faker->randomElement([Post::class,Comment::class]);
        if($type == Post::class){
            $likeable_type = Post::class;
            $likeable_id = Post::all()->random()->id;
        }else if($type == Comment::class){
            $likeable_id = Comment::all()->random()->id;
        }

        return [
           'user_id'=>User::all()->random()->id,
            'likeable_id'=> $likeable_id,
            'likeable_type'=> $likeable_type,
        ];
    }
}
