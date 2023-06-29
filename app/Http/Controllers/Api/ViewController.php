<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function views(View $view,Request $request){

        $id_ap=$request['apartment_id'];
        $visit_date=$request['visit_date'];
        $ip_address=$request['ip_address'];
        
        $view->apartment_id=$id_ap;
        $view->visit_date=$visit_date;
        $view->ip_address=$ip_address;
        dd('ciao');

        return response()->json([
            'success'=>true,
            'results'=>$view
        ]);
       
    }
}
