<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $activeSponsor = [];
        $apartments = Apartment::where('visible', '=', 1)->with(['sponsorships'])->get();
        foreach ($apartments as $apartment) {
            if(count($apartment->sponsorships) > 0){
                if($apartment->sponsorships->sortByDesc('pivot.finish_date')->first()->pivot->finish_date > now()){
                   $activeSponsor[] = $apartment; 
                }
            }
        }
        return response()->json([
            'success' => true,
            'result' => $activeSponsor,
        ]);
    }
}
