@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Message  --}}
        @if (session('message'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3" id="message">
                <div class="toast show align-items-center my-bg-success border-0" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex py-2">
                        <div class="toast-body fw-bold">
                            {{ session('message') }}
                        </div>
                        <button type="button" class="btn-close me-3 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        {{-- Welcome User  --}}
        <div class="container p-4">
            <h2 class="d-none d-lg-block">Ciao {{ Auth::user()->name }}</h2>
            <div class="w-100 text-end">
                <a class="btn btn-primary my-3" href="{{ route('user.apartment.index') }}">Vai alla lista degli appartamenti</a>
            </div>
            <h3 class="fs-3 fw-bold mb-3">Lista Appartmenti</h3>
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
                                            <div class="p-2">
                                                <img class="img-fluid rounded-3"
                                                    src="{{ asset('storage/' . $apartment->cover_image) }}"
                                                    alt="{{ $apartment->title }}">
                                            </div>
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
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row d-lg-none">
                    <div class="col-12">
                        <!--Mobile layout-->
                        <div class="card d-lg-none">
                            <img class="card-img-top" src="{{ asset('storage/' . $apartment->cover_image) }}"
                                alt=" {{ $apartment->title }}">
                            <div class="card-body">
                                <h5 class="card-title fs-3">{{ $apartment->title }}</h5>
                                <p class="card-text fs-4">Indirizzo: {{ $apartment->address }}.</p>
                                <p class="card-text fs-5">Prezzo: {{ $apartment->price }} €</p>
                                @if ($apartment->visible == true)
                                    <p><i class="fa-solid fa-eye"></i></p>
                                @elseif ($apartment->visible == false)
                                    <p><i class="fa-solid fa-eye-slash"></i></p>
                                @endif
                                <a href="{{ route('user.apartment.show', $apartment->id) }}"
                                    class="btn btn-primary">Info</a>
                            </div>
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
            @endif
        </div>
    </div>
@endsection
