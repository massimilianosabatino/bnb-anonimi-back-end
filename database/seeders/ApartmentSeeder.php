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
        $apartmentArray = config('apartments_db');

        foreach($apartmentArray as $el){

            $apartment = new Apartment();

            $users = User::inRandomOrder()->first();
            $apartment->user_id = $users->id;
            
            $apartment->title = $el['title'];
            $apartment->rooms = $el['rooms'];
            $apartment->bathrooms = $el['bathrooms'];
            $apartment->beds = $el['beds'];
            $apartment->square_meters = $el['square_meters'];
            
            $apartment->cover_image = 'uploads/' . $el['cover_image'];
    
            $apartment->address = $el['address'];
            $apartment->latitude = $el['latitude'];
            $apartment->longitude = $el['longitude'];
            $apartment->price = $el['price'];
            $apartment->slug = Str::slug($el['title'], '-');
            $apartment->save();

            //Service Pivot Seeder
            $services = Service::inRandomOrder()->take(7)->get();
    
            foreach ($services as $service) {
                $apartment->services()->attach([
                    $apartment->id => $service->id,
                ]);
            }

            //Sponsor Pivot Seeder
            $rand = rand(0,1);
            if ($rand) {
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
}
