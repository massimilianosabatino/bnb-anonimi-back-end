<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->email = $faker->email();
            $password = 'password';
            $user->password = Hash::make($password);
            $user->name = $faker->name();
            $user->surname = $faker->lastname();    
            $user->birth_date = $faker->date();                                 
            $user->save();
        }
    }
}
