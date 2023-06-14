<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
            $apartment->user_id = 1;
            //Variabile Titolo Località BnB
            $title = $faker->cityPrefix() . $faker->secondaryAddress();
            //Faker
            $apartment->title = $title;
            $apartment->rooms = $faker->randomDigitNotNull();
            $apartment->bathrooms = $faker->numberBetween(1, 4);
            $apartment->beds = $faker->randomDigitNotNull();
            $apartment->square_meters = $faker->numberBetween(40, 255);
            $apartment->cover_image = $faker->imageUrl(360, 360);
            $apartment->address = $faker->address();
            $apartment->latitude = $faker->latitude(-90, 90);
            $apartment->longitude = $faker->longitude(-180, 180);
            $apartment->price = $faker->randomFloat(2,1,999);
            $apartment->slug = Str::slug($title, '-');
            $apartment->save();
        }
    }
}
