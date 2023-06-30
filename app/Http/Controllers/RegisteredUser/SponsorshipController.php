<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Braintree\Gateway as BraintreeGateway;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

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
        //Controllo per non far modificare appartamenti diversi da quello selezionato
        if($apartment===null){
            return redirect()->route('user.apartment.index')->with('message','Operazione non consentita');
        }

        // Get last active sponsorship for this apartment
        $activeSponsor = $apartment->sponsorships->where('pivot.finish_date', '>', now())->sortBy('pivot.finish_date')->last();
        $sponsorEnd = null;
        if ($activeSponsor) {
            $sponsorEndDate = Carbon::create($activeSponsor->pivot->finish_date)->format('d-m-Y');
            $sponsorEndTime = Carbon::create($activeSponsor->pivot->finish_date)->format('h:i');

            $sponsorEnd = [
                'date' => $sponsorEndDate,
                'time' => $sponsorEndTime
            ];
            
        }

        return view('user.sponsorship.index', compact('apartment', 'sponsorships', 'activeSponsor', 'sponsorEnd'));
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
//         $sponsorships = Sponsorship::all();
// dd($_REQUEST);
        // // Get data from request
        // $plan = $_POST['planSelected'];
        // $apartmentID = $_POST['apartmentSelected'];
        // $apartment = Apartment::where('id', $apartmentID)->first();
        // $sponsorship = Sponsorship::where('id', $plan)->first();
        // $activeSponsor = $apartment->sponsorships->where('pivot.finish_date', '>', now())->sortBy('pivot.finish_date')->last();


        // // Braintree operations
        // $gateway = new BraintreeGateway([
        //     'environment' => env('ENVIRONMENT'),
        //     'merchantId' => env('MERCHANTID'),
        //     'publicKey' => env('PUBLICKEY'),
        //     'privateKey' => env('PRIVATEKEY')
        // ]);

        // $nonceFromTheClient = $_POST["paymentMethodNonce"];

        // $result = $gateway->transaction()->sale([
        //     'amount' => $sponsorship->price,
        //     // 'amount' => 2000.00, //test error
        //     'paymentMethodNonce' => $nonceFromTheClient,
        //     // 'deviceData' => $deviceDataFromTheClient,
        //     'options' => [
        //         'submitForSettlement' => True
        //     ]
        // ]);


        // // Results
        // if ($result->success) {
        //     if ($apartment->user_id == Auth::user()->id) {

        //         if ($activeSponsor) {
        //             $start = $activeSponsor->pivot->finish_date;
        //             $end = Carbon::create($start)->addHours($sponsorship->time);
        //         } else {
        //             // Set start and finish date
        //             $start = now();
        //             $end = $start->copy()->addHours($sponsorship->time);
        //         }
        //         // Write plan purchased on pivot
        //         $apartment->sponsorships()->attach($plan, ['start_date' => $start, 'finish_date' => $end]);
        //     }
            
            // $success = true;
        //     $name = $apartment->title;
            // dd($result->transaction->paymentReceipt);
            // Return for response on payment page
            // return response()->json([
            //     'success' => true,
            //     'results' => $result,
            //     'plan' => $sponsorship->name,
            //     'end' => $end->format('d-m-Y')
            // ]);
            // return view('user.sponsorship.show', compact('success', 'result', 'plan', 'end', 'name', 'sponsorships'));
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'results' => $result
        //     ]);
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

    public function confirm()
    {

    }

    public function checkout(Request $request)
    {
        // dd($request);
        $sponsorships = Sponsorship::all();

        // Get data from request
        $plan = $_POST['tier'];
        $apartmentID = $_POST['apartmentSelected'];
        $apartment = Apartment::where('id', $apartmentID)->first();
        $sponsorship = Sponsorship::where('id', $plan)->first();
        $activeSponsor = $apartment->sponsorships->where('pivot.finish_date', '>', now())->sortBy('pivot.finish_date')->last();


        // Braintree operations
        $gateway = new BraintreeGateway([
            'environment' => env('ENVIRONMENT'),
            'merchantId' => env('MERCHANTID'),
            'publicKey' => env('PUBLICKEY'),
            'privateKey' => env('PRIVATEKEY')
        ]);

        $nonceFromTheClient = $_POST["payment_method_nonce"];

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            // 'amount' => 2000.00, //test error
            'paymentMethodNonce' => $nonceFromTheClient,
            // 'deviceData' => $deviceDataFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);


        // Results
        if ($result->success) {
            if ($apartment->user_id == Auth::user()->id) {

                if ($activeSponsor) {
                    $start = $activeSponsor->pivot->finish_date;
                    $end = Carbon::create($start)->addHours($sponsorship->time);
                } else {
                    // Set start and finish date
                    $start = now();
                    $end = $start->copy()->addHours($sponsorship->time);
                }
                // Write plan purchased on pivot
                $apartment->sponsorships()->attach($plan, ['start_date' => $start, 'finish_date' => $end]);
            }
            
            $success = true;
            $name = $apartment->title;
            // dd($result->transaction->paymentReceipt);
            // Return for response on payment page
            // return response()->json([
            //     'success' => true,
            //     'results' => $result,
            //     'plan' => $sponsorship->name,
            //     'end' => $end->format('d-m-Y')
            // ]);
            $end = $end->format('d-m-Y') . ' alle ' . $end->format('h:m');
            $plan = $sponsorship->name;

            return view('user.sponsorship.checkout', compact('success', 'result', 'plan', 'end', 'name', 'sponsorships', 'apartment'));
        } else {
            $message = $result->message;
            return Redirect::back()->withErrors(['msg' => $message]);
            // response()->json([
            //     'success' => false,
            //     'results' => $result
            // ]);
        }
    }
}
