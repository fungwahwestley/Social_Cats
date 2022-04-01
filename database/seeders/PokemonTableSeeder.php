<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pokemon;

class PokemonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $p = new Pokemon();
        $p->name = "fung wah";
        $p->HP = 88;
        $p->type ="fire";
        $p->trainer_id = 1;
        $p->save();

       Pokemon::factory()->count(100)->create();
    }
}
