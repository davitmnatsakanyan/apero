<!DOCTYPE html>
<html>

<head>

    <title>Stripe Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Including the jQuery libraries -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript library -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>

<body>

<form action="registerOrder" method="GET" id="payment-form">
    <span class="payment-errors"></span>

    <div class="form-row">
        <label>
            <span>Card Number</span>
            <input type="text" size="20" data-stripe="number">
        </label>
    </div>

    <div class="form-row">
        <label>
            <span>Expiration (MM/YY)</span>
            <input type="text" size="2" data-stripe="exp_month">
        </label>
        <span> / </span>
        <input type="text" size="2" data-stripe="exp_year">
    </div>

    <div class="form-row">
        <label>
            <span>CVC</span>
            <input type="text" size="4" data-stripe="cvc">
        </label>
    </div>

    <div class="form-row">
        <label>
            <span>Billing Zip</span>
            <input type="text" size="6" data-stripe="address_zip">
        </label>
    </div>

    <input type="submit" class="submit" value="Submit Payment">
</form>

        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    Stripe.setPublishableKey('pk_test_RRDcRey63aipkR9UbaPDPRTo');
</script>
<script>
    $(function() {
        var $form = $('#payment-form');
        $form.submit(function(event) {
            // Disable the submit button to prevent repeated clicks:
            $form.find('.submit').prop('disabled', true);

            // Request a token from Stripe:
            console.log($form);
            return false;
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
</body>

</html>


{{--{!! Form::open(['url' => url('registerOrder'),'method' => 'post',]) !!}--}}
    {{--<script--}}
            {{--src="https://checkout.stripe.com/checkout.js" class="stripe-button"--}}
            {{--data-key="pk_test_RRDcRey63aipkR9UbaPDPRTo"--}}
            {{--data-amount="999"--}}
            {{--data-name="Apero"--}}
            {{--data-description="Order"--}}
            {{--data-image="/img/documentation/checkout/marketplace.png"--}}
            {{--data-locale="auto"--}}
            {{--data-zip-code="true"--}}
            {{--data-currency="eur">--}}
    {{--</script>--}}
{{--{!! Form::close() !!}--}}