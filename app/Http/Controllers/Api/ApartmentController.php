<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Set;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services')->get();
       
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
      
    }

    public function show($id)
    {
        try {
            $apartment = Apartment::where('id', $id)->with(['services', 'user','galleries'])->first();

            if ($apartment) {
                return response()->json([
                    'success' => true,
                    'results' => $apartment
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'results' => null
                ], 404);
            }
        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'results' => null
            ], 500);
        }
    }
    public function search(Request $request)
    {
        $visible_ap = Apartment::where('visible', '=', 1)->with(['services', 'user'])->get();

        $services = $request['service'];
        $latA = $request['lat'] * 3.14 / 180; //Conversione in radianti della lat della ricerca
        $lonA = $request['lon'] * 3.14 / 180; //Conversione in radianti della lon della ricerca
        $dist = $request['dist'];
        $R = 6372.795477598; //Raggio dell'equatore

        //Array Filtrato
        $filtered_apartment = [];

        //Filtri
        $rooms_rq = $request['rooms'];
        $bath_rq = $request['bath'];
        $beds_rq = $request['beds'];
        $price_rq = $request['price'];

        $activeSponsor = [];
        $apartments = Apartment::where('visible', '=', 1)->with(['sponsorships', 'services'])->get();
        foreach ($apartments as $apartment) {
            if (count($apartment->sponsorships) > 0) {
                if ($apartment->sponsorships->sortByDesc('pivot.finish_date')->first()->pivot->finish_date > now()) {
                    $activeSponsor[] = $apartment;
                }
            }
        }


        $unique = collect();
        foreach ($activeSponsor as $sponsor) {
            $unique->push($sponsor);
        }
        foreach ($visible_ap as $apartment) {
            $unique->push($apartment);
        }

        $all = $unique->unique('id');

        $serviceNumber = count($services);

        if ($latA && $lonA) {
            foreach ($all as $apartment) {
                $count = 0;
                $latB = $apartment->latitude * 3.14 / 180; // Conversione in radianti della lat dell'appartamento
                $lonB = $apartment->longitude * 3.14 / 180; //Conversione in radianti della lon dell'appartamento 
                $calc_dist = $R * acos((sin($latA) * sin($latB) + cos($latA) * cos($latB) * cos($lonA - $lonB))); //Formula trigonometrica per il calcolo della distanza 
                if ($calc_dist < $dist) {
                    if ($apartment->rooms >= $rooms_rq && $apartment->beds >= $beds_rq && $apartment->bathrooms >= $bath_rq && $apartment->price <= $price_rq) {
                        if (count($services) > 0) {
                            foreach($apartment->services as $service){
                                if (in_array($service->id,$services) && !in_array($apartment, $filtered_apartment)) {
                                    $count++;
                                    if($count === $serviceNumber){
                                        $filtered_apartment[] = $apartment;
                                    }
                                }
                            }
                        } else {
                            $filtered_apartment[] = $apartment;
                        }
                    }
                }
            }
        } else {
            if (count($services) > 0) {
                foreach ($all as $apartment) {
                    $count = 0;
                    foreach($apartment->services as $service){
                        if (in_array($service->id,$services) && !in_array($apartment, $filtered_apartment)) {
                            $count++;
                            if($count === $serviceNumber){
                                $filtered_apartment[] = $apartment;
                            }
                        }
                    }
                    
                }
            } else {
                foreach ($all as $apartment) {
                    if ($apartment->rooms >= $rooms_rq && $apartment->beds >= $beds_rq && $apartment->bathrooms >= $bath_rq && $apartment->price <= $price_rq) {
                        $filtered_apartment[] = $apartment;
                    }
                }
            }
        }


        if (count($filtered_apartment) > 0) {
            return response()->json([
                'success' => true,
                'results' => $filtered_apartment,
            ]);
        } else {
            return response()->json([
                'success' => true,
                'results' => null
            ]);
        }
    }
}
