@extends('layouts.app')
@section('script')
<!-- includes the Braintree JS client SDK -->
<script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script>
{{-- Include Jquery --}}
<script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
  <div class="my-5">
    <a href="{{ route('user.apartment.show', $apartment) }}" type="button" class="btn btn-outline-secondary mb-1">Torna all'appartamento</a>
  </div>

  <h1 class="main-title fs-3 fw-bold mb-4 text-center">Acquisto effettuato con successo!
  </h1>
  {{-- Error list --}}
  @if ($errors->any())
  @foreach ($errors->all() as $error)
  <div class="alert alert-danger my-3 col-6 col-md-3" id="autorizzazione">{{ $error }}</div>
  @endforeach
  @endif
  {{-- /Error list --}}
  {{-- Banner delle sponsorizzazioni generati dinamicamente sulla base dei dati salvati nel database --}}
  <div class="row">
    <div class="d-flex flex-wrap">
      @foreach ($sponsorships as $key => $sponsorship)
      <div class="col-12 col-md-4 text-center mb-4 {{ $sponsorship->name != $plan ? 'blurred' : '' }}">
        <div class="card tier-card bg-{{ $key + 1 }} m-2">
          <div class="car-header sponsor-title-{{ $key + 1 }}">
            {{ $sponsorship->name }}
          </div>
          <div class="card-body">
            <p class="card-subtitle mb-2 card-price">{{ $sponsorship->price }} €</p>
            <p class="card-subtitle mb-2">
              Offerta BnB Anonimi della durata di {{
              $sponsorship->time }} ore
            </p>
            <p class="card-text mx-2">
              Acquistando questo pacchetto il tuo appartamento verra' visualizzato nella pagina principale del nostro
              sito per una durata di {{ $sponsorship->time }} ore, inoltre sara' tra i primi risultati nelle ricerche
              degli utenti.
            </p>
            <input type="radio" class="btn-check" name="tier" id="tier-{{ $sponsorship->id }}" autocomplete="off"
              value="{{ $sponsorship->id }}" @checked($sponsorship->name ===
            'Premium') disabled>
            <label class="btn btn-light" for="tier-{{ $sponsorship->id }}">{{ $sponsorship->name
              }}</label>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  
  {{-- /Banner delle sponsorizzazioni generati dinamicamente sulla base dei dati salvati nel database --}}
  <div class="row">
    <div class="col-12">
      <h2>Sponsorizzazione effettuata</h2>
      <p>Da questo momento il tuo appartamento apparirà in cima ai risultati di ricerca e sarà visibile in Homepage.</p>
      <div><strong>ID transazione:</strong> {{ $result->transaction->paymentReceipt['id'] }}</div>
      <div><strong>Pacchetto acquistato:</strong> {{ $plan }}</div>
      <div><strong>Appartemento sponsorizzato:</strong> {{ $apartment->title }}</div>
      <div><strong>Prezzo:</strong> {{ $result->transaction->paymentReceipt['amount'] }}</div>
      <div><strong>Scadenza sponsorizzazione:</strong> {{ $end }}</div>
    </div>
    <div class="col-12 mt-3">
      <div id="timer"></div>
      <a id="enable-timer" href="{{ route('user.sponsorship.index', $apartment->id) }}" type="button" class="btn btn-outline-secondary mb-1 opacity-0">Sponsorizza di nuovo</a>
    </div>
  </div>
</div>

<script>
    const timer = document.getElementById("timer");

    let conta = 20;
    const time = setInterval(function () {
      if (conta === 1) {
        timer.innerHTML = '';
        clearInterval(time);
      } else {
        conta--;
        timer.innerText = `Attendi ${conta} secondi per effettuare una nuova sponsorizzazione sullo stesso appartamento.`;
      }
    }, 1000);
if(document.getElementById('enable-timer')){
    window.addEventListener('load',function(){
    let button = document.getElementById('enable-timer');
    this.setTimeout(function(){
        button.classList.remove('opacity-0');
    },20000)
})
}
</script>

@endsection