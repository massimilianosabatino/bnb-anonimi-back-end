<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function views(Request $request){
        
        $allView = View::where('ip_address', $request['ip_address'])->orderBy('visit_date')->get();
        $timeRangge = Carbon::now()->subHours(24);
        $visitForApartment = $allView->whereIn('apartment_id', $request['apartment_id'])->last();
        
        if(!$visitForApartment){
            $id_ap=$request['apartment_id'];
            $visit_date=$request['visit_date'];
            $ip_address=$request['ip_address'];
            
            $newView = new View();
            $newView->fill($request->all());
    
            $newView->save();
            return 'salvato';
        }else{
            $checkDate = $visitForApartment->visit_date < Carbon::now()->subHours(24);
            if($checkDate){
                $id_ap=$request['apartment_id'];
                $visit_date=$request['visit_date'];
                $ip_address=$request['ip_address'];
                
                $newView = new View();
                $newView->fill($request->all());
        
                $newView->save();
                return 'controllato e salvato';
            }
            return 'solo controllato';
        }
        // dd($checkDate);
        return 'ciao';
        
        // $newView->apartment_id=$id_ap;
        // $newView->visit_date=$visit_date;
        // $newView->ip_address=$ip_address;

// dd($newView);

        // return response()->json([
        //     'success'=>true,
        //     'results'=>$view
        // ]);
       
    }
}
