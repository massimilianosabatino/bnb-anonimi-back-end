<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
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
        
        $activeSponsor = $apartment->sponsorships->where('pivot.finish_date', '>', now())->get()->orderBy('pivot.finish_date', 'desc');
        dd($activeSponsor);
        dd($apartment->sponsorships->where('title', 'BorgoAppartamento 33'));

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
    public function show()
    {
        // Get data from request
        $plan = $_POST['planSelected'];
        $apartmentID = $_POST['apartmentSelected'];
        $apartment = Apartment::where('id', $apartmentID)->first();
        $sponsorship = Sponsorship::where('id', $plan)->first();


        // Braintree operations
        $gateway = new BraintreeGateway([
            'environment' => env('ENVIRONMENT'),
            'merchantId' => env('MERCHANTID'),
            'publicKey' => env('PUBLICKEY'),
            'privateKey' => env('PRIVATEKEY')
        ]);

        $nonceFromTheClient = $_POST["paymentMethodNonce"];

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonceFromTheClient,
            // 'deviceData' => $deviceDataFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        
        // Results
        if ($result->success) {
            if ($apartment->user_id == Auth::user()->id) {
                // Set start and finish date
                $start = now();
                $end = $start->copy()->addHours($sponsorship->time);
                // Write plan purchased on pivot
                $apartment->sponsorships()->attach($plan, ['start_date' => $start, 'finish_date' => $end]);
            }
            return $result;
        } else {
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
