<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 1000; $i++){
            $apartment = Apartment::inRandomOrder()->first();
            $view = new View();
            $view->apartment_id = $apartment->id;
            $view->visit_date = $faker->dateTimeThisYear();
            $view->ip_address = $faker->ipv4();
            $view->save();
        }
    }
}
