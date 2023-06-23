<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Braintree\Gateway as BraintreeGateway;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sponsorships = Sponsorship::all();
        $apartment = Apartment::where('user_id', '=', Auth::id())->where('id', '=', key($_REQUEST))->first();
       
        return view('user.sponsorship.index', compact('apartment', 'sponsorships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship, Apartment $apartment)
    {
        //dd(key($_REQUEST));
        $gateway = new BraintreeGateway([
            'environment' => env('ENVIRONMENT'),
            'merchantId' => env('MERCHANTID'),
            'publicKey' => env('PUBLICKEY'),
            'privateKey' => env('PRIVATEKEY')
          ]);
        //   dd($gateway);
          $nonceFromTheClient = $_POST["paymentMethodNonce"];

          $result = $gateway->transaction()->sale([
            'amount' => '5001.00',
            'paymentMethodNonce' => $nonceFromTheClient,
            // 'deviceData' => $deviceDataFromTheClient,
            'options' => [
              'submitForSettlement' => True
            ]
          ]);
          if($result->success){
              return $result;
          }else{
            return response()->json([
                'success' => false,
                'results' => $result
            ]);
          }
        // $apartment = Apartment::where('id', key($_REQUEST))->first();
        // if ($apartment->user_id == Auth::user()->id) {
        //     return view('user.sponsorship.show', compact('apartment', 'sponsorship'));
        // } else {
        //     return redirect()->route('user.sponsorship.index')->withErrors('Nessun appartamento');
        // }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
