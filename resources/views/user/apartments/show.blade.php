@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-9">
                <h2>{{ $apartment->title }}</h2>


                {{-- visibilita' --}}
                <p>Il tuo appartamento e' impostato su: @if ($apartment->visible == true)
                        'VISIBILE'
                    @elseif ($apartment->visible == false)
                        'NON VISIBILE'
                    @endif
                </p>

                @if ($apartment->cover_image)
                    <div class="d-flex justify-content-start show-image">
                        <img class="w-50" src="{{ asset('storage/' . $apartment->cover_image) }}"
                            alt="{{ $apartment->title }}">
                    </div>
                @endif

                <div class="apart-services row m-0 my-3">

                    @foreach ($apartment->services as $service)
                        <div class="col-2 single-service d-flex flex-column justify-content-center align-items-center p-2 text-light">
                            <div>
                                {!! $service->icon !!}
                            </div>
                            <div>
                                {{ $service->name }}
                            </div>

                        </div>
                    @endforeach

                </div>

                <ul class="list-group list-group-flush col-6">
                    <li class="list-group-item">Stanze: {{ $apartment->rooms }}</li>
                    <li class="list-group-item">Bagni: {{ $apartment->bathrooms }}</li>
                    <li class="list-group-item">Letti: {{ $apartment->beds }}</li>
                    <li class="list-group-item">Metri quadri: {{ $apartment->square_meters }}&#13217</li>
                    <li class="list-group-item">Indirizzo: {{ $apartment->address }}</li>
                    <li class="list-group-item">Prezzo: {{ $apartment->price }} €</li>
                </ul>


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
                </div>


            </div>


            <div class="col-3 gy-4 extra">

                {{-- vai a messaggi appartamento --}}
                <div>
                    <p class="text-center sponsor">Domande dai clienti</p>
                    <a href="{{ route('user.apartment.index', $apartment) }}" role="button"
                        class="btn btn-success w-100">Messaggi ricevuti</a>
                </div>
                {{-- visualizza le statistiche --}}
                <div>
                    <p class="text-center sponsor">Visualizza le statistiche</p>
                    <a href="{{ route('user.apartment.index', $apartment) }}" role="button"
                        class="btn btn-success w-100">STATISTICHE !</a>
                </div>
                {{-- sponsorizzazioni --}}
                <div>
                    <p class="text-center sponsor">Vuoi sponsorizzare il tuo appartamento?</p>
                    <a href="{{ route('user.apartment.index', $apartment) }}" role="button"
                        class="btn btn-info w-100">Sponsorizza!</a>
                </div>

            </div>


        </div>

    </div>
@endsection
