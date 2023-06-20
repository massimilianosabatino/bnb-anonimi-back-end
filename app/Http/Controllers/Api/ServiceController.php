<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return response()->json([
            'success' => true,
            'results' => $services
        ]);
    }
    public function show($id){
        $service = Service::where('id', $id)->with('apartments')->first();

        return response()->json([
            'success' => true,
            'results' => $service
        ]);

    }
}
