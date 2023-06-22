<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ServiceController;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// {latitude}/{longitude}/{dist}/{array}

// API Apartments
Route::get('apartments', [ApartmentController::class,'index']);
Route::get('apartment/{id}', [ApartmentController::class,'show']);
Route::post('search',[ApartmentController::class,'search']);


// API Services
Route::get('services', [ServiceController::class,'index']);
Route::get('service/{id}', [ServiceController::class,'show']);
