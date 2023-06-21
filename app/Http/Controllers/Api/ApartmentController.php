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
    public function search(array $params)
    {
        $apartments = Apartment::all();
        // $apartment = $apartments->filter(function ($apartment,$latitude,$longitude,$dist) {
        //     $calc_dist = sqrt(pow(($apartment->latitude - $latitude), 2) + pow(($apartment->longitude - $longitude), 2));
        //     if ($calc_dist < $dist) {
        //         return $apartment;
        //     }
        // });
        $filtered_apartment=[];
        foreach($apartments as $apartment){
            $calc_dist = sqrt(pow(($apartment->latitude - $latitude), 2) + pow(($apartment->longitude - $longitude), 2));
            if ($calc_dist < $dist) {
                array_push($filtered_apartment,$apartment);
            }
        }
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }
}
