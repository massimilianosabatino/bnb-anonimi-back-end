@extends('layouts.app')
@section('script')
<!-- includes the Braintree JS client SDK -->
<script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script>
{{-- Include Jquery --}}
<script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div id="dropin-wrapper">
                <div id="checkout-message"></div>
                <div id="dropin-container"></div>
                <button id="submit-button">Submit payment</button>
              </div>
              <script>
                var button = document.querySelector('#submit-button');
              
                braintree.dropin.create({
                  // Insert your tokenization key here
                  authorization: {{ env('AUTHORIZATION') }},
                  container: '#dropin-container'
                }, function (createErr, instance) {
                  button.addEventListener('click', function () {
                    instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
                      // When the user clicks on the 'Submit payment' button this code will send the
                      // encrypted payment information in a variable called a payment method nonce
                      $.ajax({
                        type: 'POST',
                        url: 'api/checkout',
                        data: {'paymentMethodNonce': payload.nonce}
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
</div>


@endsection