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
            <div class="col-auto col-md-6">
                <img class="img-fluid" src="{{ asset('img/front.png') }}" alt="Anteprima front-end">
            </div>
            <div class="col-auto col-md-6">
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
        <div class="row p-4 my-4 text-center gx-md-4 justify-content-between">
            <div class="col-12 col-md-3 mb-4 mb-md-0">
                <div class="rounded-2 border bg-white shadow ratio ratio-1x1">
                    <div class="box-content">
                        <div class="number fs-1 mb-2">
                            {{ $apartments }}
                        </div>
                        <div class="number-text fw-bold">
                            Appartamenti inseriti
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-4 mb-md-0">
                <div class="rounded-2 border bg-white shadow ratio ratio-1x1">
                    <div class="box-content">
                        <div class="number fs-1  mb-2">
                            {{ $sponsored }}
                        </div>
                        <div class="number-text fw-bold">
                            Appartamenti sponsorizzati
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="rounded-2 border bg-white shadow ratio ratio-1x1">
                    <div class="box-content">
                        <div class="number fs-1 mb-2">
                            {{ $messagesCount }}
                        </div>
                        <div class="number-text fw-bold position-relative">
                            Messaggi ricevuti
                            <small class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">non letti {{ $messagesUnread }}</small>
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
                            <p class="card-subtitle mb-2 card-price">2.99 €</p>
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
                            premium
                        </div>
                        <div class="card-body">
                            <p class="card-subtitle mb-2 card-price">5.99 €</p>
                            <p class="card-subtitle mb-2">
                                Offerta BnB Anonimi della durata di 72 ore
                            </p>
                            <p class="card-text mx-2">
                                Acquistando questo pacchetto il tuo appartamento verra' visualizzato nella pagina principale del nostro sito per una durata di 72 ore, inoltre sara' tra i primi risultati nelle ricerche degli utenti.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center mb-4">
                    <div class="card tier-card bg-3 m-2">
                        <div class="car-header sponsor-title-3">
                            deluxe
                        </div>
                        <div class="card-body">
                            <p class="card-subtitle mb-2 card-price">9.99 €</p>
                            <p class="card-subtitle mb-2">
                                Offerta BnB Anonimi della durata di 144 ore
                            </p>
                            <p class="card-text mx-2">
                                Acquistando questo pacchetto il tuo appartamento verra' visualizzato nella pagina principale del nostro sito per una durata di 144 ore, inoltre sara' tra i primi risultati nelle ricerche degli utenti.
                            </p>
                        </div>
                    </div>
                </div>
                <p class="text-center">Accedi al dettaglio dell'appartamento che vuoi sponsorizzare e rendilo visibile per la durata del pacchetto scelto. Puoi anche acquistare più sponsorizzazioni per un appartamento, queste verranno sommate è il tuo appartamento sarà maggiornmente visibile per più tempo!</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-4 py-4">
    <div class="row">
        <div class="col">
            <h2 class="text-center mb-4">Visualizzazioni totali per i tuoi appartamenti</h2>
        </div>
        <div class="col">
            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div>
</div>
@section('jsScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  

<script type="text/javascript">

  

      var labels =  {{ Js::from($labels) }};

      var controllerData =  {{ Js::from($dataSets) }};

      let currYear = new Date().getFullYear();

      let views = controllerData.data[currYear]
  

      const data = {

        labels: labels,

        datasets: [{

          label: 'Totale visite',

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