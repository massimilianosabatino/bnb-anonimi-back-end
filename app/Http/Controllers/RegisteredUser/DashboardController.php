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
        
        $apartmentId = Apartment::where('user_id', Auth::id())->select('id')->get();

        $conf = View::whereIn('apartment_id', $apartmentId)->get();
        //Per l'anno corrente raggruppati per mese
        // $apartmentsView = View::whereIn('apartment_id', $apartmentId)
        // ->whereYear('visit_date', date('Y'))
        // ->selectRaw('MONTH(visit_date) as month, COUNT(*) as count')
        // ->groupBy('month')
        // ->get();

        //separati per anno, bisogna cambiare gestione data
        $apartmentsView = View::whereIn('apartment_id', $apartmentId)
        ->selectRaw('YEAR(visit_date) as year, MONTH(visit_date) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->get();

        // dd($apartmentsView->groupBy('year'), $conf);

        $labels = [];
        

        // $views = DB::table('views')
        //     ->whereIn('apartment_id', $apartmentId)
        //     ->get()
        //     ->groupBy(function($val) {
        //         return Carbon::parse($val->visit_date)->format('Y-m');
        //   });

          $data = [];
        // foreach($views as $view){
            // $labels = $views->keys();
            // $values = $views->values();
            // foreach($values as $el){
            //     $data[] = count($el);
            // }

        // }

        foreach($apartmentsView->groupBy('year') as $key => $year){
            // dd($key);
            $tempData = [];
            
            for($i=1; $i <= 12; $i++){
                $month = date('F', mktime(0,0,0,$i));
                $count = 0;
                
                foreach($year as $views){
                    if($views->month == $i){
                        $count = $views->count;
                        break;
                    }
                
                }
                array_push($tempData, $count);
                array_push($labels, $month);
            }
            $data[$key] = $tempData;
            
        }
        $labels = array_unique($labels);
        

        $dataSets = [
            'label' => 'Views',
            'data' => $data
        ];
        
        //Card count
        $apartments = Apartment::where('user_id' , '=', Auth::id())->count();

        $sponsored = DB::table('apartment_sponsorship')
        ->whereIn('apartment_id', $apartmentId)
        ->where('finish_date', '>', now())
        ->count();
        
        $messages = DB::table('messages')
        ->whereIn('apartment_id', $apartmentId)
        ->get();
        $messagesCount = count($messages);
        $messagesUnread = count($messages->where('read', false));
        
        return view('user.dashboard',compact('apartments', 'sponsored', 'messagesCount', 'messagesUnread', 'labels', 'dataSets'));
    }
}
