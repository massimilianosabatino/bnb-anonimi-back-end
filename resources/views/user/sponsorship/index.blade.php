@extends('layouts.app')
@section('script')
<!-- includes the Braintree JS client SDK -->
<script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script>
{{-- Include Jquery --}}
<script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="sponsorshipIndex container">

    <div class="my-5">
        <a href="{{ url()->previous() }}" type="button" class="btn btn-outline-secondary mb-1">Back</a>
    </div>

    <h1 class="main-title fs-3 fw-bold mb-4 text-center">Acquista una sponsorizzazione e metti il tuo appartamento in
        evidenza!
    </h1>

    {{-- Error list --}}
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger my-3 col-6 col-md-3" id="autorizzazione">{{ $error }}</div>
    @endforeach
    @endif
    {{-- /Error list --}}

    {{-- Check if has sponsor ad show banner --}}
    @if($activeSponsor)
    <div id="active-sponsor" class="row">
        <div class="col-auto alert alert-success">
            Questo appartamento è sponsorizzato fino al {{ $sponsorEnd['date'] }} alle {{ $sponsorEnd['time'] }}. Puoi estendere la scadenza acquistando un nuovo pacchetto.
        </div>
    </div>
    @endif
    {{-- /Check if has sponsor ad show banner --}}

    {{-- Banner delle sponsorizzazioni generati dinamicamente sulla base dei dati salvati nel database --}}
    <div class="row">
        <div class="d-flex flex-wrap">
            @foreach ($sponsorships as $key => $sponsorship)
            <div class="col-12 col-md-4 text-center mb-4">
                <div class="card tier-card bg-{{ $key + 1 }} m-2">
                    <div class="car-header sponsor-title-{{ $key + 1 }}">
                        {{ $sponsorship->name }}
                    </div>
                    <div class="card-body">
                        <p class="card-subtitle mb-2 card-price" >{{ $sponsorship->price }} €</p>
                        <p class="card-subtitle mb-2">
                            Offerta BnB Anonimi della durata di {{
                            $sponsorship->time }} ore
                        </p>
                        <p class="card-text mx-2">
                            Acquistando questo pacchetto il tuo appartamento verra' visualizzato nella pagina principale del nostro sito per una durata di {{ $sponsorship->time }} ore, inoltre sara' tra i primi risultati nelle ricerche degli utenti.
                        </p>
                        <input type="radio" class="btn-check" name="tier" id="tier-{{ $sponsorship->id }}"
                            autocomplete="off" value="{{ $sponsorship->id }}" @checked($sponsorship->name ===
                        'Premium')>
                        <label class="btn btn-light" for="tier-{{ $sponsorship->id }}">{{ $sponsorship->name
                            }}</label>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- /Banner delle sponsorizzazioni generati dinamicamente sulla base dei dati salvati nel database --}}
    {{-- Drop In Braintree --}}
    <div class="row payment mb-4">
        <div class="col-8">
            <div id="dropin-wrapper">
                <div id="checkout-message"></div>
                <div id="dropin-container"></div>
                <button id="submit-button">Submit payment</button>
            </div>
            <script>
                // Get plain selected from dom
                function getPlainsValue() {
                    let tierSelected = null;
                    let tierButton = document.getElementsByName('tier');

                    for (i = 0; i < tierButton.length; i++) {
                        if (tierButton[i].checked)
                            tierSelected = tierButton[i].value
                        }
                        return tierSelected;
                }
                // /Get plain selected from dom

                // Braintree Drop-In
                var button = document.querySelector('#submit-button');
                
                braintree.dropin.create({
                    // Insert your tokenization key here
                    authorization: '{{ env('AUTHORIZATION') }}',
                    container: '#dropin-container'
                }, function (createErr, instance) {
                    button.addEventListener('click', function () {
                    // Get plain chosen
                    let planSelected = getPlainsValue();
                    
                    instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
                        // When the user clicks on the 'Submit payment' button this code will send the
                        // encrypted payment information in a variable called a payment method nonce
                        // Add also plan selected 
                        $.ajax({
                        type: 'POST',
                        url: 'sponsorship/checkout',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'paymentMethodNonce': payload.nonce,
                            'planSelected': planSelected,
                            'apartmentSelected': {{ $apartment->id }}
                        }
                        }).done(function(result) {
                        
                        // Tear down the Drop-in UI
                        instance.teardown(function (teardownErr) {
                            if (teardownErr) {
                            console.error('Could not tear down Drop-in UI!');
                            } else {
                            console.info('Drop-in UI has been torn down!');
                            // Remove the 'Submit payment' button
                            $('#submit-button').remove();
                            }
                        });
                
                        if (result.success) {
                            // console.log(result.results);
                            //Revome banner for activer sponsor after payment
                            let active_sponsor = document.getElementById('active-sponsor');
                            if (active_sponsor) {
                                active_sponsor.classList.add('d-none');
                            }
                            $('#checkout-message').html(`<h1>Sponsorizzazione effettuata</h1><p>Da questo momento il tuo appartamento apparirà in cima ai risultati di ricerca e sarà visibile in Homepage.</p><div><strong>ID transazione:</strong> ${result.results.transaction.paymentReceipt.id}</div><div><strong>Pacchetto acquistato:</strong> ${result.plan}</div><div><strong>Prezzo:</strong> ${result.results.transaction.paymentReceipt.amount}</div><div><strong>Scadenza sponsorizzazione:</strong> ${result.end}</div>`);
                        } else {
                            console.log(result);
                            $('#checkout-message').html(`<h1>Qualcosa è andato storto</h1><p>Controlla di aver inserito correttamente i dati della carta.</p><p>Se hai inserito correttamente i dati e il credito sulla carta è sufficiente (ad esempio se stai utilizzando una ricaricabile) allora puoi provare a contattare il servizio clienti.</p><p class="transaction-error">Errore: <span>${result.results.message}</span></p>`);
                        }
                        });
                    });
                    });
                });
            </script>
        </div>
    </div>
    {{-- /Drop In Braintree --}}
</div>
@endsection