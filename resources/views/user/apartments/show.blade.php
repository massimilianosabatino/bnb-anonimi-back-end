@extends('layouts.app')

@section('content')
    <div class="container apartment-show">

        <div class="row">
            <div class="col-12">
                <div class="my-5">
                    <a href="{{ route('user.apartment.index') }}" type="button"
                        class="btn btn-outline-secondary mb-3">Back</a>
                </div>

                <div class="row">
                    <h2 class="fs-3 fw-bold mb-3">{{ strtoupper($apartment->title) }}</h2>

                    <div class="col-7">
                        {{-- colonna Immagine --}}
                        @if ($apartment->cover_image)
                            <div class="show-img-container col-8">
                                <img class="img-fluid" src="{{ $apartment->cover_image }}" alt="{{ $apartment->title }}">
                            </div>
                        @endif
                    </div>
                    {{-- fine immagine --}}

                    {{-- colonna Gallery --}}
                    <div class="col-5 d-flex flex-wrap">
                        <div class="gallery d-flex flex-wrap">
                            @if ($apartment->galleries)
                                @foreach ($apartment->galleries as $gallery)
                                    <div class="img-cont">
                                        <img src="{{ $gallery->image_path }}"
                                            alt="{{ $apartment->slug }}" class="img-gallery">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-7">
                    {{-- visibilita' --}}
                    <p class="mt-3 visible">Il tuo appartamento e' impostato su:
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
            <div class="row">
                <div class="col">
                    <div class="col apart-services row m-0 my-3">
                        <div class="d-flex flex-wrap">

                            @foreach ($apartment->services as $service)
                                <div
                                    class="single-service col-2 text-light d-flex justify-content-center align-items-center p-2">
                                    <div>
                                        {!! $service->icon !!}
                                    </div>
                                    <div class="service-name">
                                        {{ $service->name }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- dettagli appartamento --}}
                    <ul class="col list-group list-group-flush ">
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

                <div class=" d-flex flex-md-column col-5 parent-extra pb-3 mt-auto">
                    <h4 class="mx-auto fw-bolder">Tasti rapidi</h4>
                    <div class="tasti-extra d-flex justify-content-between flex-wrap">

                        {{-- //vai a messaggi appartamento --}}
                        <a href="{{ route('user.message.index', $apartment->id) }}" role="button"
                            class="icon-cont color-1">
                            <div class="bottone">
                                <div>Messaggi</div><i class="fa-solid fa-envelope"></i>
                            </div>
                        </a>

                        {{-- // visualizza le statistiche --}}
                        {{-- <a href="{{ route('user.apartment.index', $apartment) }}" role="button" class="icon-cont color-2">
                            <div class="bottone">
                                <div>Statistiche</div><i class="fa-solid fa-chart-simple"></i>
                            </div>
                        </a> --}}

                        {{-- //sponsorizzazioni --}}
                        <a href="{{ route('user.sponsorship.index', $apartment) }}" role="button"
                            class="icon-cont color-3">
                            <div class="bottone">
                                <div>Sponsor</div><i class="fa-solid fa-money-bill-trend-up"></i>
                            </div>
                        </a>

                        {{-- bottone per tornare all'index  --}}
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
                        <button type="button" class="btn icon-cont color-3 elimina me-auto" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <div class="bottone">
                                <div>Elimina</div><i class="fa-solid fa-trash"></i>
                            </div>

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
        <div class="row my-4">
            <div class="col-12">
                <h2 class="text-center mb-4">Visualizzazioni totali per i tuoi appartamenti</h2>
            </div>
            <div class="col-12">
                <canvas id="myChart" height="100px"></canvas>
            </div>
            </div>
        </div>
    </div>
@section('jsScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
      
    
    <script type="text/javascript">
    
          var controllerData =  {{ Js::from($dataSets) }};
    
          let currYear = new Date().getFullYear();
          console.log(controllerData)
          let views = controllerData.data[currYear]
      

          let data = {
    
            labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', ' Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
    
            datasets: [{
    
              label: `Totale visite - anno ${currYear}`,
    
              backgroundColor: 'rgb(255, 99, 132)',
    
              borderColor: 'rgb(255, 99, 132)',
    
              data: views,
    
            }]
    
          };
    
      
    
          const config = {
    
            type: 'line',
    
            data: data,
    
            options: {}
    
          };
    
      
    
          const myChart = new Chart(
    
            document.getElementById('myChart'),
    
            config
    
          );
    
      
    
    </script>
@endsection
@endsection
