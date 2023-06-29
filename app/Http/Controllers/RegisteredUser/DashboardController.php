<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('user_id' , '=', Auth::id())->count();
        $apartmentId = Apartment::where('user_id', Auth::id())->select('id')->get();

        $views = DB::table('views')
            ->whereIn('apartment_id', $apartmentId)
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->visit_date)->format('Y-m');
          });

          $data = [];
        // foreach($views as $view){
            $labels = $views->keys();
            $values = $views->values();
            foreach($values as $el){
                $data[] = count($el);
            }

        // }
        

        $sponsored = DB::table('apartment_sponsorship')
        ->whereIn('apartment_id', $apartmentId)
        ->where('finish_date', '>', now())
        ->count();
        
        $messages = DB::table('messages')
        ->whereIn('apartment_id', $apartmentId)
        ->get();
        $messagesCount = count($messages);
        $messagesUnread = count($messages->where('read', false));
        
        return view('user.dashboard',compact('apartments', 'sponsored', 'messagesCount', 'messagesUnread', 'views', 'labels', 'data'));
    }
}
