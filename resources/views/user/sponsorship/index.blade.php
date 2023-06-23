@extends('layouts.app')

@section('content')
    <div class="sponsorshipIndex container">

        <div class="my-5">
            <a href="{{ url()->previous() }}" type="button" class="btn btn-outline-secondary mb-1">Back</a>
        </div>

        <h1 class="main-title fs-3 fw-bold mb-4 text-center">Acquista una sponsorizzazione e metti il tuo appartamento in evidenza!
        </h1>

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
                        <div class="card tier-card bg-{{ $key + 1 }} m-2">
                            <div class="card-body">
                                <p class="card-subtitle mb-2 card-price" style="color: white">{{ $sponsorship->price }} €</p>
                                <p class="card-subtitle mb-2" style="color: white">Offerta BnB Anonimi della durata di {{ $sponsorship->time }} ore</p>
                                <a href="{{ route('user.sponsorship.show', $sponsorship, $apartment ) }}" class="btn btn-outline-light btn-tier">{{ $sponsorship->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Cards degli appartamenti dell'utente registrato con relativi bottoni per scegliere la sponsorizzazione --}}

        <div class="row">

            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card h-100 cardhover">
                    <img src="{{ $apartment->cover_image }}" class="card-img-top" alt="{{ $apartment->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        <p class="card-text">Indirizzo: {{ $apartment->address }}</p>
                        <div class="mt-auto d-grid">
                            <a href="{{ route('user.sponsorship.show', [1, $apartment->id]) }}"
                                class="btn text-white mb-2" style="background-color: rgb(180, 180, 180)">Standard!</a>
                            <a href="{{ route('user.sponsorship.show', [2, $apartment->id]) }}"
                                class="btn text-white mb-2" style="background-color: rgb(150, 150, 150)">Premium!</a>
                            <a href="{{ route('user.sponsorship.show', [3, $apartment->id]) }}"
                                class="btn text-white mb-2" style="background-color: rgb(110, 110, 110)">Deluxe!</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
