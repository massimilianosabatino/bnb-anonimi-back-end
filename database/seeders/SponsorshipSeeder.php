<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships=[
            [
                'name'=>'Standard',
                'price'=>2.99,
                'time'=>24
            ],
            [
                'name'=>'Premium',
                'price'=>5.99,
                'time'=>72
            ],
            [
                'name'=>'Deluxe',
                'price'=>9.99,
                'time'=>144
            ]
            ];
            foreach($sponsorships as $sponsorship){
                $newSponsor=new Sponsorship();
                $newSponsor->name=$sponsorship['name'];
                $newSponsor->price=$sponsorship['price'];
                $newSponsor->time=$sponsorship['time'];
                $newSponsor->save();
            }
    }
}
