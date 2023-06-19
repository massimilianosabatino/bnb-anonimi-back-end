<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('user_id' , '=', Auth::id())->take(2)->get();
        return view('user.dashboard',compact('apartments'));
    }
}
