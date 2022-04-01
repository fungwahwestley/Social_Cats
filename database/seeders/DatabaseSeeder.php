<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TrainerTableSeeder::class);
        $this->call(PokemonTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(ProfileTableSeeder::class);

    }
}
