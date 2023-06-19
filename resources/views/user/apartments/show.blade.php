@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col">
                <h2>{{ $apartment->title }}</h2>


                 {{-- visibilita' --}}
                 <p>Il tuo appartamento e': @if ($apartment->visible == true)
                    'VISIBILE'
                @elseif ($apartment->visible == false)
                    'NON VISIBILE'
                @endif </p>

                @if ($apartment->cover_image)
                    <div class="d-flex justify-content-start">
                        <img class="w-50" src="{{ asset('storage/' . $apartment->cover_image) }}"
                            alt="{{ $apartment->title }}">
                    </div>
                @endif

                <ul class="list-group list-group-flush col-6">
                    <li class="list-group-item">Rooms: {{ $apartment->rooms }}</li>
                    <li class="list-group-item">Bathrooms: {{ $apartment->bathrooms }}</li>
                    <li class="list-group-item">Beds: {{ $apartment->beds }}</li>
                    <li class="list-group-item">Square meters: {{ $apartment->square_meters }}</li>
                    <li class="list-group-item">Address: {{ $apartment->address }}</li>
                    <li class="list-group-item">Price: {{ $apartment->price }}</li>
                </ul>

               

                {{-- bottone per tornare all'index  --}}
                <a href="{{ route('user.apartment.index', $apartment) }}" role="button"
                    class="btn btn-success">Torna ai tuoi appartamenti</a>

                {{-- bottone per edit --}}
                <a href="{{ route('user.apartment.edit', $apartment) }}" role="button"
                    class="btn btn-warning">Edit</a>

                

            </div>


        </div>

    </div>
@endsection
