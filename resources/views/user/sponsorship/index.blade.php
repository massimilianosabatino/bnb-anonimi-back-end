@extends('layouts.app')

@section('content')
    <div class="sponsorshipIndex container">

        <h1 class="main-title">Acquista una sponsorizzazione in un appartamento per metterlo in evidenza!</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger my-3 col-6 col-md-3" id="autorizzazione">{{ $error }}</div>
            @endforeach
        @endif

        {{-- Banner delle sponsorizzazioni generati dinamicamente sulla base dei dati salvati nel database --}}

        <div class="row">
            <div class="d-flex flex-wrap">
                @foreach ($sponsorships as $key => $sponsorship)
                <div class="col-12 col-md-4 text-center mb-4">
                    <div class="card bg-{{ $key+1 }} m-2">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white">{{ $sponsorship->name }}</h5>
                            <h6 class="card-subtitle mb-2" style="color: white">Prezzo: {{ $sponsorship->price }} €</h6>
                            <p class="card-text" style="color: white">Ore: {{ $sponsorship->time }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Cards degli appartamenti dell'utente registrato con relativi bottoni per scegliere la sponsorizzazione --}}
        
        <div class="row">
            @foreach ($apartments as $apartment)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 cardhover">
                        <img src="{{$apartment->cover_image}}" class="card-img-top" alt="{{$apartment->title}}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{$apartment->title}}</h5>
                            <p class="card-text">Indirizzo: {{$apartment->address}}</p>
                            <div class="mt-auto d-grid">
                                <a href="{{ route('user.sponsorship.show', [1, $apartment->id] ) }}" class="btn text-white mb-2" style="background-color: rgb(180, 180, 180)">Standard!</a>
                                <a href="{{ route('user.sponsorship.show', [2, $apartment->id] ) }}" class="btn text-white mb-2" style="background-color: rgb(150, 150, 150)">Premium!</a>
                                <a href="{{ route('user.sponsorship.show', [3, $apartment->id] ) }}" class="btn text-white mb-2" style="background-color: rgb(110, 110, 110)">Deluxe!</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
