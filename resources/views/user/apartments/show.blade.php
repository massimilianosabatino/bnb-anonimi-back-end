@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card w-25 my-5">
                    
                    @if ($apartment->cover_image)
                        <div>
                            <img class="card-img-top" src="{{ asset('storage/' . $apartment->cover_image) }}" alt=" {{ $apartment->title }}">
                        </div>
                    @endif


                    <div class="card-body">
                        <p class="card-text">{{ $apartment->title }}</p>
                        <p class="card-text">{{ $apartment->rooms }}</p>
                        <p class="card-text">{{ $apartment->bathrooms }}</p>
                        <p class="card-text">{{ $apartment->beds }}</p>
                        <p class="card-text">{{ $apartment->square_meters }}</p>
                        <p class="card-text">{{ $apartment->address }}</p>
                        <p class="card-text">{{ $apartment->latitude }}</p>
                        <p class="card-text">{{ $apartment->longitude }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
