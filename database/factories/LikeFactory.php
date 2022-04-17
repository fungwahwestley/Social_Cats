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
        if(Comment::all()->count() > Post::all()->count()){
            $likeable_id = Comment::all()->random()->id;
        }else{
            $likeable_id = Post::all()->random()->id;
        }

        return [
           'user_id'=>User::all()->random()->id,
            'likeable_id'=> $likeable_id,
            'likeable_type'=> $this->faker->randomElement([Post::class,Comment::class]),
        ];
    }
}
