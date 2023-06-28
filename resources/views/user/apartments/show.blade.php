@extends('layouts.app')

@section('content')
    <div class="container apartment-show">

        <div class="row">
            <div class="col-12 m-5">
                <div class="my-5">
                    <a href="{{ route('user.apartment.index') }}" type="button"
                        class="btn btn-outline-secondary mb-3">Back</a>
                </div>

                <div class="row">
                    <h2 class="fs-3 fw-bold mb-3">{{ strtoupper($apartment->title) }}</h2>

                    <div class="col-7">
                        {{-- Immagine --}}
                        @if ($apartment->cover_image)
                            <div class="show-img-container col-8">
                                <img class="img-fluid" src="{{ $apartment->cover_image }}" alt="{{ $apartment->title }}">
                            </div>
                        @endif
                    </div>

                    <div class="col-4 gallery">
                        prova
                    </div>
                </div>



                <div class="row">
                    <div class="col-7">
                        {{-- visibilita' --}}
                        <p class="mt-3">Il tuo appartamento e' impostato su:
                            @if ($apartment->visible == true)
                                'VISIBILE'
                            @elseif ($apartment->visible == false)
                                'NON VISIBILE'
                            @endif
                        </p>

                        <div class="apart-services row m-0 my-3">

                            @foreach ($apartment->services as $service)
                                <div class="single-service col-2 text-light d-flex justify-content-center align-items-center p-2">
                                    <div>
                                        {!! $service->icon !!}
                                    </div>
                                    <div>
                                        {{ $service->name }}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="row">
                        <ul class="col-7 list-group list-group-flush ">
                            <li class="list-group-item">Stanze: {{ $apartment->rooms }}</li>
                            <li class="list-group-item">Bagni: {{ $apartment->bathrooms }}</li>
                            <li class="list-group-item">Letti: {{ $apartment->beds }}</li>
                            <li class="list-group-item">Metri quadri: {{ $apartment->square_meters }}&#13217</li>
                            <li class="list-group-item">Indirizzo: {{ $apartment->address }}</li>
                            <li class="list-group-item">Prezzo: {{ $apartment->price }} €</li>
                            @if ($sponsorEnd)
                                <li class="list-group-item sponsor">Sponsorizzato fino al {{ $sponsorEnd['date'] }}
                                    alle
                                    {{ $sponsorEnd['time'] }}</li>
                            @endif
                        </ul>

                        <div class=" d-flex flex-md-column col-4 parent-extra">
                            <div class="tasti-extra d-flex flex-column ">

                                {{-- //vai a messaggi appartamento --}}
                                <div class="bottone">

                                    <a href="{{ route('user.message.index', $apartment->id) }}" role="button"
                                        class="">Messaggi ricevuti</a>
                                </div>

                                {{-- // visualizza le statistiche --}}
                                <div class="bottone">

                                    <a href="{{ route('user.apartment.index', $apartment) }}" role="button"
                                        class="">Statistiche</a>
                                </div>

                                {{-- //sponsorizzazioni --}}
                                <div class="bottone">

                                    <a href="{{ route('user.sponsorship.index', $apartment) }}" role="button"
                                        class="">Sponsorizza</a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>









                <div class="my-3">
                    {{-- bottone per tornare all'index  --}}
                    <a href="{{ route('user.apartment.index', $apartment) }}" role="button" class="btn btn-success">Torna
                        ai
                        tuoi appartamenti
                    </a>

                    {{-- bottone per edit --}}
                    <a href="{{ route('user.apartment.edit', $apartment) }}" role="button"
                        class="btn btn-warning">Modifica
                        questo appartamento
                    </a>

                    {{-- bottone per delete --}}
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Elimina appartamento
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Confermi di voler eliminare {{ $apartment->title }} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('user.apartment.destroy', $apartment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Cancella</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>


            {{-- <div class=" d-flex flex-md-column col-12 col-md-4 gy-4 extra">

                 //vai a messaggi appartamento 
                <div class="me-2 mb-md-3">
                  
                    <a href="{{ route('user.message.index', $apartment->id) }}" role="button"
                        class="btn btn-success w-100">Messaggi ricevuti</a>
                </div>
                // visualizza le statistiche
                <div class="me-2 mb-md-3">
                    
                    <a href="{{ route('user.apartment.index', $apartment) }}" role="button"
                        class="btn btn-success w-100">Statistiche</a>
                </div>
                //sponsorizzazioni
                <div class="me-2 mb-md-3">
                    
                    <a href="{{ route('user.sponsorship.index', $apartment) }}" role="button"
                        class="btn btn-info w-100">Sponsorizza</a>
                </div>

            </div> --}}


        </div>

    </div>
@endsection
