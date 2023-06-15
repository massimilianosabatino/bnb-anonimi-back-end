<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            $newMessage = new Message();
    
            //Get apartment from db and attach to message
            $apartment = Apartment::inRandomOrder()->first();
            
            $newMessage->apartment_id = $apartment->id;
    
            $newMessage->name = $faker->firstName() . ' ' . $faker->lastName();
            $newMessage->email = $faker->email();
            $newMessage->content = $faker->realText();
            $newMessage->send_date = $faker->date();
            $newMessage->read = $faker->numberBetween(0,1);
            
            $newMessage->save();
        }
    }
}
