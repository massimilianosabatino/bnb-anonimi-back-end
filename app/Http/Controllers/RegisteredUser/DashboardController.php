<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('user_id' , '=', Auth::id())->get();
        $totalApartments = count($apartments);
        $apartments = $apartments->take(2);
        return view('user.dashboard',compact('apartments', 'totalApartments'));
    }
}
