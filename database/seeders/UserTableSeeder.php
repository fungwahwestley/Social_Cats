<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "admin user";
        $user->admin = 1;
        $user->email = "adminuser@gmail.com";
        $user->password = "adminuserpass";
        $user->save();

        User::factory()->count(5)->create();
    }
}
