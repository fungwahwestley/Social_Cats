<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new Profile();
        $p->username = "catlover8";
        $p->bio = "Hi my name is FungWah! I have 2 cats. A tabby and tortise shell.";
        $p->user_id = 1;
        $p->save();

        Profile::factory()->count(5)->create();
    }
}
