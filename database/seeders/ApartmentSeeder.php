<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 10; $i++) {
            $apartment = new Apartment();
            $users = User::inRandomOrder()->first();
            $apartment->user_id = $users->id;
            //Variabile Titolo Località BnB
            $title = $faker->cityPrefix() . $faker->secondaryAddress();
            //Faker
            $apartment->title = $title;
            $apartment->rooms = $faker->randomDigitNotNull();
            $apartment->bathrooms = $faker->numberBetween(1, 4);
            $apartment->beds = $faker->randomDigitNotNull();
            $apartment->square_meters = $faker->numberBetween(40, 255);
            $apartment->cover_image = fake()->image('public/storage/uploads',640,480, null, false);
            $apartment->address = $faker->address();
            $apartment->latitude = $faker->latitude(-90, 90);
            $apartment->longitude = $faker->longitude(-180, 180);
            $apartment->price = $faker->randomFloat(2, 1, 999);
            $apartment->slug = Str::slug($title, '-');
            $apartment->save();
            //Service Pivot Seeder
            $services = Service::inRandomOrder()->take(7)->get();

            foreach ($services as $service) {
                $apartment->services()->attach([
                    $apartment->id => $service->id,
                ]);
            }
            //Sponsor Pivot Seeder
            $sponsorship = Sponsorship::inRandomOrder()->first();

            $startDate = date("Y-m-d H:i:s");
            $finishDate = date("Y-m-d H:i:s", strtotime("+{$sponsorship->time} hours"));
            $apartment->sponsorships()->attach([

                $apartment->id => [
                    'sponsorship_id'=>$sponsorship->id,
                    'start_date' => $startDate,
                    'finish_date' => $finishDate
                ]

            ]);
        }
    }
}
