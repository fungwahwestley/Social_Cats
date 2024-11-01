<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'caption' => $this->faker->realText,
            'user_id' => User::all()->random()->id,
            'path'=> null,
        ];

    }
}
