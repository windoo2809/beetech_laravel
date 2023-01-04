<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<50; $i++){
            $users = new Users();
            $users->user_name = fake()->unique()->name;
            $users->email = fake()->unique()->safeEmail;
            $users->password = fake()->password;
            $users->first_name = fake()->name;
            $users->birthday = fake()->date;
            $users->last_name = fake()->name;
            $users->save();
        }
    }
}
