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

    {{-- Check if has sponsor --}}
    @if(count($apartment->sponsorships) > 0)
    <div class="row">
        <div class="col">
            ATTENZIONE - Già sponsorizzato
        </div>
    </div>
    @endif
    {{-- /Check if has sponsor --}}

    {{-- Banner delle sponsorizzazioni generati dinamicamente sulla base dei dati salvati nel database --}}
    <div class="row">
        <div class="d-flex flex-wrap">
            @foreach ($sponsorships as $key => $sponsorship)
            <div class="col-12 col-md-4 text-center mb-4">
                <div class="card tier-card bg-{{ $key + 1 }} m-2">
                    <div class="card-body">
                        <p class="card-subtitle mb-2 card-price" style="color: white">{{ $sponsorship->price }} €</p>
                        <p class="card-subtitle mb-2" style="color: white">Offerta BnB Anonimi della durata di {{
                            $sponsorship->time }} ore</p>
                        <input type="radio" class="btn-check" name="tier" id="tier-{{ $sponsorship->id }}"
                            autocomplete="off" value="{{ $sponsorship->id }}" @checked($sponsorship->name ===
                        'Premium')>
                        <label class="btn btn-secondary" for="tier-{{ $sponsorship->id }}">{{ $sponsorship->name
                            }}</label>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row payment">
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
                        console.log(result);
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
                            $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
                        } else {
                            console.log(result);
                            $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
                        }
                        });
                    });
                    });
                });
            </script>
        </div>
    </div>

    {{-- Cards degli appartamenti dell'utente registrato con relativi bottoni per scegliere la sponsorizzazione --}}

    {{-- <div class="row">

        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="card h-100 cardhover">
                <img src="{{ $apartment->cover_image }}" class="card-img-top" alt="{{ $apartment->title }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $apartment->title }}</h5>
                    <p class="card-text">Indirizzo: {{ $apartment->address }}</p>
                    <div class="mt-auto d-grid">
                        <a href="{{ route('user.sponsorship.show', [1, $apartment->id]) }}" class="btn text-white mb-2"
                            style="background-color: rgb(180, 180, 180)">Standard!</a>
                        <a href="{{ route('user.sponsorship.show', [2, $apartment->id]) }}" class="btn text-white mb-2"
                            style="background-color: rgb(150, 150, 150)">Premium!</a>
                        <a href="{{ route('user.sponsorship.show', [3, $apartment->id]) }}" class="btn text-white mb-2"
                            style="background-color: rgb(110, 110, 110)">Deluxe!</a>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
</div>
@endsection