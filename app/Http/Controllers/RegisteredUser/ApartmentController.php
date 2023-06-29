<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $apartments = Apartment::where('user_id', '=', Auth::id())->with('sponsorships')->get();
        
        
        return view('user.apartments.index', compact('apartments') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('user.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {

        $data = $request->validated();

        $newApartments = new Apartment();
        $newApartments->fill($data);
        $newApartments->user_id = Auth::id();
        $newApartments->slug = Str::slug($data['title']);

        if (isset($data['cover_image'])) {
            $newApartments->cover_image = Storage::put('uploads', $data['cover_image']);
        }

        $apiUrl = "https://api.tomtom.com/search/2/geocode/";
        $apiAddress = $data['address'];
        $apiKey = env('API_KEY');
        $address = Http::withOptions(['verify' => false])->get($apiUrl . $apiAddress . $apiKey)->json();
        //  ci sara' da cambiare per tomtom
        $newApartments->latitude = $address['results'][0]['position']['lat'];
        $newApartments->longitude = $address['results'][0]['position']['lon'];
        $newApartments->save();

        // salvo i services selezionati nella pivot solo se esistono nell"array service
        if ($request['service']) {
            $newApartments->services()->attach($request['service']);
        }

        return redirect()->route('user.apartment.show', $newApartments->id)->with('message', 'Appartamento creato con successo!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->user_id == Auth::user()->id) {
            
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

            
            return view('user.apartments.show', compact('apartment', 'sponsorEnd'));
        } else {
            return redirect()->route('user.apartment.index')->withErrors('Nessun appartamento');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        if ($apartment->user_id == Auth::user()->id) {
            $services = Service::all();
            return view('user.apartments.edit', compact('apartment', 'services'));
        } else {
            return redirect()->route('user.apartment.index')->withErrors('Nessun appartamento');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();
        $apartment->slug = Str::slug($data['title']);


        if (isset($data['cover_image'])) {

            if ($apartment->cover_image) {
                Storage::delete($apartment->cover_image);
            }

            $apartment->cover_image = Storage::put('uploads', $data['cover_image']);
        }


        $apartment->update($data);
        if ($request['service']) {
            $apartment->services()->sync($request['service']);
        }

        return redirect()->route('user.apartment.show', $apartment->id)->with('message', "L' appartamento: $apartment->title è stato modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $old_id = $apartment->id;

        // if($apartment->cover_image){
        //     Storage::delete($apartment->cover_image);
        // }

        $apartment->delete();

        return redirect()->route('user.apartment.index')->with('message', "Appartamento $old_id eliminato con successo");
    }
}
