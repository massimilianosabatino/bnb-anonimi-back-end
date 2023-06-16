<?php

namespace App\Http\Controllers\RegisteredUser;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Str;
use App\Model\User;
use App\Models\Service;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $apartments = Apartment::where('user_id' , '=', Auth::id())->get();
        return view('user.apartments.index',compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services= Service::all();
        
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

        
        if(isset($data['cover_image'])){
            $newApartments->cover_image = Storage::put('uploads', $data['cover_image']);
        }
        
        //  ci sara' da cambiare per tomtom
        $newApartments->latitude = 40.12345;
        $newApartments->longitude = 40.12345;
        $newApartments->save();

        // salvo i services selezionati nella pivot solo se esistono nell"array service
        if ($request['service']) {
        $newApartments->services()->attach($request['service']);
        }

        return redirect()->route('user.apartment.index')->with('message', 'Appartamento creato con successo!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('user.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services= Service::all();
        return view('user.apartments.edit',compact('apartment', 'services'));
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

        $old_image = $apartment->cover_image;
        

        if(empty($data['cover_image'])){
            if($apartment->cover_image){
                $apartment->cover_image=$old_image;
            }

        }else {
            if (isset($data['cover_image'])) {

                if($apartment->cover_image){
                    Storage::delete($apartment->cover_image);
                }

                $apartment->cover_image = Storage::put('uploads', $data['cover_image']);
            }
        }

        $apartment->update($data);
        if ($request['service']) {
            $apartment->services()->sync($request['service']);
            }

        return redirect()->route('user.apartment.index')->with('message', "Apartment $apartment->title edited with success");
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