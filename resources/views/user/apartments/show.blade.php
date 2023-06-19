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
                        <img class="w-50" src="{{ asset('storage/uploads/' . $apartment->cover_image) }}"
                            alt="{{ $apartment->title }}">
                    </div>
                @endif

                <div class="apart-services row">

                    @foreach ($apartment->services as $service)
                        <div class="col-2 single-service justify-content-center align-items-center">
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
                    <li class="list-group-item">Rooms: {{ $apartment->rooms }}</li>
                    <li class="list-group-item">Bathrooms: {{ $apartment->bathrooms }}</li>
                    <li class="list-group-item">Beds: {{ $apartment->beds }}</li>
                    <li class="list-group-item">Square meters: {{ $apartment->square_meters }}</li>
                    <li class="list-group-item">Address: {{ $apartment->address }}</li>
                    <li class="list-group-item">Price: {{ $apartment->price }}</li>
                </ul>



                {{-- bottone per tornare all'index  --}}
                <a href="{{ route('user.apartment.index', $apartment) }}" role="button" class="btn btn-success">Torna ai
                    tuoi appartamenti</a>

                {{-- bottone per edit --}}
                <a href="{{ route('user.apartment.edit', $apartment) }}" role="button" class="btn btn-warning">Modifica
                    questo appartamento</a>

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
                        class="btn btn-success w-100">STATS !</a>
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
