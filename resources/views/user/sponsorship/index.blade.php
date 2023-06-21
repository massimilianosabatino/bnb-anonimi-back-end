@extends('layouts.app')

@section('content')
    <div class="sponsorshipIndex container">

        <h1 class="main-title">Scegli quale appartamento vuoi sponsorizzare!</h1>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger my-3 col-6 col-md-3" id="autorizzazione">{{ $error }}</div>
            @endforeach
        @endif
        
        <div class="row">
            @foreach ($apartments as $apartment)
                <div class="col-3">
                    <div class="card mb-4" style="width: 18rem;">
                        <img src="{{$apartment->cover_image}}" class="card-img-top" alt="{{$apartment->title}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$apartment->title}}</h5>
                            <p class="card-text">Address: {{$apartment->address}}</p>
                            <a href="{{ route('user.sponsorship.show', [1, $apartment->id] ) }}" class="btn btn-primary">Standard!</a>
                            <a href="{{ route('user.sponsorship.show', [2, $apartment->id] ) }}" class="btn btn-primary">Premium!</a>
                            <a href="{{ route('user.sponsorship.show', [3, $apartment->id] ) }}" class="btn btn-primary">Deluxe!</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
