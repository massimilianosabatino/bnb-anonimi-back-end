<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('user_id' , '=', Auth::id())->count();
        $apartmentId = Apartment::where('user_id', Auth::id())->select('id')->get();
        // dd($apartmentId);
        // $sponsored = Apartment::where('user_id', Auth::id())->with('sponsorships')->where('finish_date', '>', now())->get();
        $sponsored = DB::table('apartment_sponsorship')
        ->whereIn('apartment_id', $apartmentId)
        ->where('finish_date', '>', now())
        ->count();
        
        // $totalApartments = count($apartments);
        // $apartments = $apartments->take(2);
        return view('user.dashboard',compact('apartments', 'sponsored'));
    }
}
