@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Message --}}
    @if (session('message'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="message">
        <div class="toast show align-items-center my-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex py-2">
                <div class="toast-body fw-bold">
                    {{ session('message') }}
                </div>
                <button type="button" class="btn-close me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    {{-- Welcome User --}}
    <div class="container p-4">
        <div class="row">
            <div class="col">
                <h4 class="d-none d-lg-block">Ciao {{ Auth::user()->name }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="text-center my-4">Carica e gestisci i tuoi appartamenti, sponsorizzali e massimizza i tuoi profitti</h1>
                <p class="text-center fw-bold my-4">Da questa sezione hai il pieno controllo sui tuoi appartamenti, gestisci semplicemente le tue strutture e migliora le performance con le sponsorizzazioni</h3>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-6">
                <img class="img-fluid" src="{{ asset('img/front.png') }}" alt="Anteprima front-end">
            </div>
            <div class="col-6">
                <div class="side-img-text">
                    <div class="fw-bold">
                        Carica un nuovo appartamento
                    </div>
                    <p>Inserisci i dettagli del tuo appartamento e caricalo sulla nostra piattaforma.</p>
                </div>
                <div class="side-img-text">
                    <div class="fw-bold">
                        Modifica i tuoi appartamenti
                    </div>
                    <p>La nostra piattaforma ti permette di modificare in qualsiasi momento tutti i dettagli del tuo appartamento.</p>
                </div>
                <div class="side-img-text">
                    <div class="fw-bold">
                        Sponsorizza gli appartamenti
                    </div>
                    <p>Puoi sponsorizzare i tuoi appartamenti per mostrarli in homepage e per farli salire nei risultati di ricerca degli utenti. Un incentivo per massimizzare i tuoi guadagni.</p>
                </div>
                <div class="side-img-text">
                    <div class="fw-bold">
                        Messaggi ricevuti
                    </div>
                    <p>Puoi visualizzare tutti i messaggi ricevuti per ogni appartamento. I messaggi sono privati, solo tu puoi vederli! Il resto della conversazione può avvenire privatamente, per garantire la massima privacy.</p>
                </div>
                <div class="side-img-text">
                    <div class="fw-bold">
                        Statistiche personali
                    </div>
                    <p>Controlla il risultati raggiunti da i tuoi appartamenti, scopri quelli più richiesti. Otttieni tutti dati utili per ottimizzare le performance.</p>
                </div>
            </div>
        </div>
        <div class="row p-4 my-4 text-center gx-4 justify-content-between">
            <div class="col-3">
                <div class="rounded-2 border bg-white shadow ratio ratio-1x1">
                    <div class="box-content">
                        <div class="number fs-1 mb-2">
                            {{ $totalApartments }}
                        </div>
                        <div class="number-text fw-bold">
                            Appartamenti inseriti
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="rounded-2 border bg-white shadow ratio ratio-1x1">
                    <div class="box-content">
                        <div class="number fs-1  mb-2">
                            13
                        </div>
                        <div class="number-text fw-bold">
                            Appartamenti sponsorizzati
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="rounded-2 border bg-white shadow ratio ratio-1x1">
                    <div class="box-content">
                        <div class="number fs-1  mb-2">
                            10
                        </div>
                        <div class="number-text fw-bold">
                            Messaggi ricevuti
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="secondary-section py-5">
    <div class="container">
        <div class="row">
            <h2 class="text-center mb-4">Piani di sponsorizzazione</h2>
            <div class="d-flex flex-wrap">
                <div class="col-12 col-md-4 text-center mb-4">
                    <div class="card tier-card bg-1 m-2">
                        <div class="car-header sponsor-title-1">
                            standard
                        </div>
                        <div class="card-body">
                            <p class="card-subtitle mb-2 card-price">5.99 €</p>
                            <p class="card-subtitle mb-2">
                                Offerta BnB Anonimi della durata di 24 ore
                            </p>
                            <p class="card-text mx-2">
                                Acquistando questo pacchetto il tuo appartamento verra' visualizzato nella pagina principale del nostro sito per una durata di 24 ore, inoltre sara' tra i primi risultati nelle ricerche degli utenti.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center mb-4">
                    <div class="card tier-card bg-2 m-2">
                        <div class="car-header sponsor-title-2">
                            standard
                        </div>
                        <div class="card-body">
                            <p class="card-subtitle mb-2 card-price">9.99 €</p>
                            <p class="card-subtitle mb-2">
                                Offerta BnB Anonimi della durata di 48 ore
                            </p>
                            <p class="card-text mx-2">
                                Acquistando questo pacchetto il tuo appartamento verra' visualizzato nella pagina principale del nostro sito per una durata di 48 ore, inoltre sara' tra i primi risultati nelle ricerche degli utenti.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center mb-4">
                    <div class="card tier-card bg-3 m-2">
                        <div class="car-header sponsor-title-3">
                            standard
                        </div>
                        <div class="card-body">
                            <p class="card-subtitle mb-2 card-price">12.99 €</p>
                            <p class="card-subtitle mb-2">
                                Offerta BnB Anonimi della durata di 144 ore
                            </p>
                            <p class="card-text mx-2">
                                Acquistando questo pacchetto il tuo appartamento verra' visualizzato nella pagina principale del nostro sito per una durata di 144 ore, inoltre sara' tra i primi risultati nelle ricerche degli utenti.
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
        
        
        
        
            {{-- <div class="rounded-2 border bg-white shadow p-4 my-4">
            <h3 class="fs-3 fw-bold mb-3">Appartmenti</h3>
            <div class="row gx-4">
                
            </div>






            <div class="w-100 text-end">
                <a class="btn btn-primary my-3" href="{{ route('user.apartment.index') }}">Vai alla lista degli
                    appartamenti</a>
            </div>
            
            @if (!$apartments->isEmpty())
            <div class="row card-body justify-content-center">
                <div class="col-12">
                    <table class="table d-none d-lg-block align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Immagine</th>
                                <th scope="col">Appartmenti</th>
                                <th scope="col">Indirizzo</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Visibile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartments as $apartment)
                            <tr>
                                <td class="w-25">
                                    <a href="{{ route('user.apartment.show', $apartment->id) }}">
                                        <div class="p-2">
                                            <img class="img-fluid rounded-3" src="{{ $apartment->cover_image }}"
                                            alt="{{ $apartment->title }}">
                                        </div>
                                    </a>
                                </td>
                                    <td>{{ $apartment->title }}</td>
                                    <td class="card-text">{{ substr($apartment->address, 0, 50) . '...' }}</td>
                                    <td>{{ $apartment->price }} €</td>
                                    @if ($apartment->visible == true)
                                    <td class="text-center"><i class="fa-solid fa-eye"></i></td>
                                    @elseif ($apartment->visible == false)
                                    <td class="text-center"><i class="fa-solid fa-eye-slash"></i></td>
                                    @endif
                            </tr>
                            @endforeach

                            <caption class="text-center mt-3">Al momento ci sono {{ $totalApartments }} appartamenti registrati sul tuo account.</caption>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row d-lg-none">
                <div class="col-12">
                    <!--Mobile layout-->
                    @foreach ($apartments as $apartment)
                    <div class="card d-lg-none my-2">
                        <a href="{{ route('user.apartment.show', $apartment->id) }}">
                            <img class="card-img-top" src="{{ $apartment->cover_image }}" alt=" {{ $apartment->title }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title fs-3">{{ $apartment->title }}</h5>
                            <p class="card-text fs-4">Indirizzo: {{ $apartment->address }}.</p>
                            <p class="card-text fs-5">Prezzo: {{ $apartment->price }} €</p>
                            @if ($apartment->visible == true)
                            <p><i class="fa-solid fa-eye"></i></p>
                            @elseif ($apartment->visible == false)
                            <p><i class="fa-solid fa-eye-slash"></i></p>
                            @endif
                            <a href="{{ route('user.apartment.show', $apartment->id) }}" class="btn btn-primary">Info</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-danger mb-0 w-25">
            Nessun appartamento inserito
        </div>
        <div>
            <a href="{{ route('user.apartment.create') }}" class="btn btn-primary my-3">Aggiungi nuovo appartamento</a>
        </div>
        @endif --}}
    </div>
</div>
@endsection