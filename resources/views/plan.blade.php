@extends('layouts.app')

@section('content')
                @if (count($errors) > 0)
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1>{{ $plan['id'] }}</h1>
                        

                            <div class="loginbox">

                            <h2><!-- Ola {{ Auth::user()->username }}, escolheu o plano --> <b>{{ $plan['name'] }}</b></h2>

                            <h5>{{ $plan->amount / 100 }} {{ $plan->currency }}/{{ $plan->interval }}</h5>
                            <br>
                            <hr>
                            <br>
                            <label>Proceda ao pagamento</label><br>
                            <br>

                            <form action="{{ route('subscribe') }}" method="POST" id="payment-form">

                            {{ csrf_field() }}

                            <label>
                            <br><b>Card Number</b>
                            </label>
                            <input autocomplete='off' value="4242 4242 4242 4242" data-stripe="number" size='20' type='text' required>

                            <label>
                                <b>CVC</b>
                            </label>
                            <input autocomplete='off' placeholder='ex. 311' data-stripe="cvc" size='4' type='text' required>

                            <label>
                                <b>Expiration Month</b>
                            </label>
                            <input placeholder='MM' value="{{ date('d') }}" data-stripe="exp_month" size='2' type='text' required>

                            <label>
                                <b>Year</b>
                            </label>
                            <input placeholder='YY' data-stripe="exp_year" size='2'  value="{{ date( 'y', strtotime('+ 4 year')) }}" type='text' required>

                            <label>
                                <b>Coupon Code</b>
                            </label>
                            <input autocomplete='off' placeholder='Coupon code' name="coupon" type='text'>
                            

                            <input type="hidden" name="plan" value="{{ $plan['id'] }}">
                            <button type="submit" id="lbutton">Pagar {{ $plan['amount'] / 100 }}€</button>

                        </form>
                        </div>

    


    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">

        Stripe.setPublishableKey("{{ config('services.stripe.key') }}");

        $(function() {
            var $form = $('#payment-form');
            $form.submit(function(event) {
                // Disable the submit button to prevent repeated clicks:
                $form.find('.submit').prop('disabled', true);

                // Request a token from Stripe:
                Stripe.card.createToken($form, stripeResponseHandler);

                // Prevent the form from being submitted:
                return false;
            });
        });

        function stripeResponseHandler(status, response) {
            // Grab the form:
            var $form = $('#payment-form');

            if (response.error) { // Problem!

                // Show the errors on the form:
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.submit').prop('disabled', false); // Re-enable submission

            } else { // Token was created!

                // Get the token ID:
                var token = response.id;

                // Insert the token ID into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="stripeToken">').val(token));

                // Submit the form:
                $form.get(0).submit();
            }
        };
    </script>
@endsection