@extends('layouts.app')

@section('content')
    <div class="container apartment-show">

        <div class="row">
            <div class="col-lg-12">
                <div class="my-5">
                    <a href="{{ route('user.apartment.index') }}" type="button"
                        class="btn btn-outline-secondary mb-3">Back</a>
                </div>

                <div class="row align-items-center">
                    <div class="col-8">
                        <h2 class="fs-3 fw-bold mb-3">{{ strtoupper($apartment->title) }}</h2>
                    </div>
                    {{-- Pulsanti mobile --}}
                    <div class="btn-group btn-mobile col-3 ms-auto mb-3 d-flex align-items-center d-lg-none col-4">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-display="static" aria-expanded="false">
                            Opzioni
                        </button>
                        {{-- CONTENUTO DROP DOWN --}}
                        <div class="dropdown-menu dropdown-menu-end">
                            <ul class="d-flex flex-wrap list-unstyled col-12 ul-mobile justify-content-center">
                                <li class="col-6">
                                    
                                    <a class="dropdown-item icon-cont color-1"
                                        href="{{ route('user.message.index', $apartment->id) }}">
                                        <div class="bottone">
                                            <div>Messaggi</div><i class="fa-solid fa-envelope"></i>
                                        </div>
                                    </a>
                                </li>
                                {{-- <li class="col-6">

                                    <a class="dropdown-item icon-cont color-2"
                                        href="{{ route('user.apartment.index', $apartment) }}">
                                        <div class="bottone">
                                            <div>Stats</div><i class="fa-solid fa-chart-simple"></i>
                                        </div>
                                    </a>
                                </li> --}}
                                <li class="col-6">

                                    <a class="dropdown-item icon-cont color-3"
                                        href="{{ route('user.sponsorship.index', $apartment) }}">
                                        <div class="bottone">
                                            <div>Sponsor</div><i class="fa-solid fa-money-bill-trend-up"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-6">

                                    <a class="dropdown-item icon-cont color-3"
                                        href="{{ route('user.gallery.show', $apartment->id) }}">
                                        <div class="bottone">
                                            <div>Galleria</div><i class="fa-solid fa-image"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-6">

                                    <a class="dropdown-item icon-cont color-1"
                                        href="{{ route('user.apartment.edit', $apartment) }}">
                                        <div class="bottone">
                                            <div>Modifica</div><i class="fa-solid fa-pen-to-square"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-6">

                                    <button type="button" class="btn icon-cont color-2 elimina" data-bs-toggle="modal"
                                        data-bs-target="#piero">
                                        <div class="bottone">
                                            <div>Elimina</div><i class="fa-solid fa-trash"></i>
                                        </div>
                                    </button>


                                </li>
                            </ul>
                        </div>
                        {{-- MODALE DEL DROPDOWN --}}
                        <div class="modal fade" id="piero" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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

                    <div class="col-lg-7">
                        {{-- colonna Immagine --}}
                        @if ($apartment->cover_image)
                            <div class="show-img-container col-lg-8">
                                <img class="img-fluid" src="{{ $apartment->cover_image }}" alt="{{ $apartment->title }}">
                            </div>
                        @endif
                    </div>
                    {{-- fine immagine --}}

                    {{-- colonna Gallery --}}
                    <div class="col-lg-5 d-flex flex-wrap">
                        <div class="gallery d-flex flex-wrap">
                            @if ($apartment->galleries)
                                @foreach ($apartment->galleries->take(3) as $gallery)
                                    <div class="img-cont">
                                        <img src="{{ $gallery->image_path }}" alt="{{ $apartment->slug }}"
                                            class="img-gallery">
                                    </div>
                                @endforeach
                                @if (count($apartment->galleries) > 2)
                                    <a href="{{ route('user.gallery.show', $apartment->id) }}"
                                        class="img-cont gallery-link position-relative">
                                        <img src="{{ $apartment->galleries->slice(count($apartment->galleries) - 1)->first()->image_path }}"
                                            alt="{{ $apartment->slug }}" class="img-gallery">
                                        <div class="on-gallery">Guarda piu' foto</div>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>



            <div class="row justify-content-center m-0">
                <div class="col-lg-7">
                    {{-- visibilita' --}}
                    {{-- md+ SIZE --}}
                    <p class="mt-3 visible d-none d-md-block">Il tuo appartamento e' impostato su:
                        <span>
                            @if ($apartment->visible == true)
                                'VISIBILE'
                            @elseif ($apartment->visible == false)
                                'NON VISIBILE'
                            @endif
                        </span>
                    </p>
                    {{-- sm to md SIZE --}}
                    <p class="mt-3 visible d-md-none p-0 text-center">
                        <span>
                            @if ($apartment->visible == true)
                                'VISIBILE'
                            @elseif ($apartment->visible == false)
                                'NON VISIBILE'
                            @endif
                        </span>
                    </p>
                </div>
            </div>

            {{-- servizi --}}
            <div class="row m-0">
                <div class="col">
                    <div class="apart-services row m-0 my-3 d-flex flex-wrap justify-content-start">
                        {{-- <div class="d-flex "> --}}
                        @foreach ($apartment->services as $service)
                            <div
                                class="single-service col-lg-2 text-light d-flex justify-content-center align-items-center p-2">
                                <div>
                                    {!! $service->icon !!}
                                </div>
                                <div class="service-name d-none d-sm-block">
                                    {{ $service->name }}
                                </div>
                            </div>
                        @endforeach
                        {{-- </div> --}}
                    </div>
                    {{-- dettagli appartamento --}}
                    <ul class="col-lg list-group list-group-flush ">
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
                </div>


                {{-- sezione tasti --}}

                <div class=" d-flex flex-md-column col-lg-5 parent-extra pb-3 mt-auto d-none d-lg-block">
                    <h4 class="mx-auto fw-bolder text-center">Tasti rapidi</h4>
                    <div class="tasti-extra d-flex justify-content-center flex-wrap">

                        {{-- //vai a messaggi appartamento --}}
                        <a href="{{ route('user.message.index', $apartment->id) }}" role="button"
                            class="icon-cont color-1">
                            <div class="bottone">
                                <div>Messaggi</div><i class="fa-solid fa-envelope"></i>
                            </div>
                        </a>

                        {{-- // visualizza le statistiche --}}
                        <a href="{{ route('user.apartment.index', $apartment) }}" role="button"
                            class="icon-cont color-2">
                            <div class="bottone">
                                <div>Statistiche</div><i class="fa-solid fa-chart-simple"></i>
                            </div>
                        </a>

                        {{-- //sponsorizzazioni --}}
                        <a href="{{ route('user.sponsorship.index', $apartment) }}" role="button"
                            class="icon-cont color-3">
                            <div class="bottone">
                                <div>Sponsor</div><i class="fa-solid fa-money-bill-trend-up"></i>
                            </div>
                        </a>

                        {{-- bottone per la galleria  --}}
                        <a href="{{ route('user.gallery.show', $apartment->id) }}" role="button"
                            class="btn icon-cont color-1">
                            <div class="bottone">
                                <div>Galleria</div><i class="fa-solid fa-image"></i>
                            </div>
                        </a>

                        {{-- bottone per edit --}}
                        <a href="{{ route('user.apartment.edit', $apartment) }}" role="button"
                            class="btn icon-cont color-2">
                            <div class="bottone">
                                <div>Modifica</div><i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </a>

                        {{-- bottone per delete --}}
                        <button type="button" class="btn icon-cont color-3 elimina" data-bs-toggle="modal"
                            data-bs-target="#giacomo">
                            <div class="bottone">
                                <div>Elimina</div><i class="fa-solid fa-trash"></i>
                            </div>

                        </button>

                        <div class="modal fade" id="giacomo" tabindex="-1" aria-labelledby="giacomoLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="giacomoLabel">Cancella</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Confermi di voler eliminare {{ $apartment->title }} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
@endsection
