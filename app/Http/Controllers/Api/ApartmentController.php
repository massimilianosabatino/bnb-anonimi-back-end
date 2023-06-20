<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(){
        $apartments=Apartment::with('services')->paginate(1);
        return response()->json([
            'success'=>true,
            'results'=>$apartments
        ]);
    }

    public function show ($id){
        try{
            $apartment=Apartment::where('id', $id)->with('services')->first();

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
           }catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'results' => null
            ], 500);
            }

}
}