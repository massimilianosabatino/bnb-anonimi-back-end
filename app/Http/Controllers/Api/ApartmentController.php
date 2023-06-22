<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;

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
            $apartment = Apartment::where('id', $id)->with('services')->first();

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
        $latA = $request['lat'] * 3.14 / 180; //Conversione in radianti della lat della ricerca
        $lonA = $request['lon'] * 3.14 / 180; //Conversione in radianti della lon della ricerca
        $dist = $request['dist'];
        $R = 6372.795477598; //Raggio dell'equatore
        $apartments = Apartment::all();

        $filtered_apartment=[];
        foreach($apartments as $apartment){
            
            $latB = $apartment->latitude * 3.14 / 180; // Conversione in radianti della lat dell'appartamento
            $lonB = $apartment->longitude * 3.14 / 180; //Conversione in radianti della lon dell'appartamento 
            $calc_dist = $R * acos((sin($latA)* sin($latB) + cos($latA) * cos($latB) * cos($lonA-$lonB))); //Formula trigonometrica per il calcolo della distanza 
            if ($calc_dist < $dist) {
                array_push($filtered_apartment,$apartment);
            }
        }
    if(count($filtered_apartment) > 0 ){
        return response()->json([
            'success' => true,
            'results' => $filtered_apartment
        ]);
    }else{
        return response()->json([
            'success' => true,
            'results' => null
        ]);
    }
        
    }
}
