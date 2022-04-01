<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trainer;

class PokemonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->firstName(),
            'HP' => $this->faker->numberBetween(10, 100),
            'type' => $this->faker->randomElement(['water', 'fire', 'grass', 'electric']),
            'trainer_id' => Trainer::all()->random()->id,
        ];
    }
}
