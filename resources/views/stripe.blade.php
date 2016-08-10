{{--<!DOCTYPE html>--}}
{{--<html>--}}

{{--<head>--}}

    {{--<title>Stripe Tutorial</title>--}}

    {{--<!-- Latest compiled and minified Bootstrap CSS -->--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">--}}

    {{--<!-- Including the jQuery libraries -->--}}
    {{--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>--}}

    {{--<!-- Latest compiled and minified Bootstrap JavaScript library -->--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}

{{--</head>--}}

{{--<body>--}}
{{--<div class="container">--}}

    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<h1 class="text-primary" style="text-align: center;">Create order</h1>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="col-md-6 col-md-offset-3">--}}
            {{--{!! Form::open(['url' => url('registerOrder'),'method' => 'post', 'data-parsley-validate']) !!}--}}

            {{--<div class="form-group" id="first-name-group">--}}
                {{--{!! Form::label('firstName', 'First Name:') !!}--}}
                {{--{!! Form::text('first_name', null, [--}}
                    {{--'class'                         => 'form-control',--}}
                    {{--'required'                      => 'required',--}}
                    {{--'data-parsley-required-message' => 'First name is required',--}}
                    {{--'data-parsley-trigger'          => 'change focusout',--}}
                    {{--'data-parsley-pattern'          => '/^[a-zA-Z]*$/',--}}
                    {{--'data-parsley-minlength'        => '2',--}}
                    {{--'data-parsley-maxlength'        => '32',--}}
                    {{--'data-parsley-class-handler'    => '#first-name-group'--}}
                    {{--]) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group" id="last-name-group">--}}
                {{--{!! Form::label('lastName', 'Last Name:') !!}--}}
                {{--{!! Form::text('last_name', null, [--}}
                    {{--'class'                         => 'form-control',--}}
                    {{--'required'                      => 'required',--}}
                    {{--'data-parsley-required-message' => 'Last name is required',--}}
                    {{--'data-parsley-trigger'          => 'change focusout',--}}
                    {{--'data-parsley-pattern'          => '/^[a-zA-Z]*$/',--}}
                    {{--'data-parsley-minlength'        => '2',--}}
                    {{--'data-parsley-maxlength'        => '32',--}}
                    {{--'data-parsley-class-handler'    => '#last-name-group'--}}
                    {{--]) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group" id="email-group">--}}
                {{--{!! Form::label('email', 'Email address:') !!}--}}
                {{--{!! Form::email('email', null, [--}}
                    {{--'class' => 'form-control',--}}
                    {{--'placeholder'                   => 'email@example.com',--}}
                    {{--'required'                      => 'required',--}}
                    {{--'data-parsley-required-message' => 'Email name is required',--}}
                    {{--'data-parsley-trigger'          => 'change focusout',--}}
                    {{--'data-parsley-class-handler'    => '#email-group'--}}
                    {{--]) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group" id="product-group">--}}
                {{--{!! Form::label('product', 'Select product:') !!}--}}
                {{--{!! Form::select('product', ['book' => 'Book ($10)', 'game' => 'Game ($20)', 'movie' => 'Movie ($15)'], 'Book', [--}}
                    {{--'class'                       => 'form-control',--}}
                    {{--'required'                    => 'required',--}}
                    {{--'data-parsley-class-handler'  => '#product-group'--}}
                    {{--]) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group" id="cc-group">--}}
                {{--{!! Form::label(null, 'Credit card number:') !!}--}}
                {{--{!! Form::text(null, null, [--}}
                    {{--'class'                         => 'form-control',--}}
                    {{--'required'                      => 'required',--}}
                    {{--'data-parsley-type'             => 'number',--}}
                    {{--'maxlength'                     => '16',--}}
                    {{--'data-parsley-trigger'          => 'change focusout',--}}
                    {{--'data-parsley-class-handler'    => '#cc-group'--}}
                    {{--]) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group" id="ccv-group">--}}
                {{--{!! Form::label(null, 'Card Validation Code (3 or 4 digit number):') !!}--}}
                {{--{!! Form::text(null, null, [--}}
                    {{--'class'                         => 'form-control',--}}
                    {{--'required'                      => 'required',--}}
                    {{--'data-parsley-type'             => 'number',--}}
                    {{--'data-parsley-trigger'          => 'change focusout',--}}
                    {{--'maxlength'                     => '4',--}}
                    {{--'data-parsley-class-handler'    => '#ccv-group'--}}
                    {{--]) !!}--}}
            {{--</div>--}}

            {{--<div class="row">--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group" id="exp-m-group">--}}
                        {{--{!! Form::label(null, 'Ex. Month') !!}--}}
                        {{--{!! Form::selectMonth(null, null, [--}}
                            {{--'class'                 => 'form-control',--}}
                            {{--'required'              => 'required'--}}
                        {{--], '%m') !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group" id="exp-y-group">--}}
                        {{--{!! Form::label(null, 'Ex. Year') !!}--}}
                        {{--{!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [--}}
                            {{--'class'             => 'form-control',--}}
                            {{--'required'          => 'required'--}}
                            {{--]) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--{!! Form::submit('Place order!', ['class' => 'btn btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}--}}
            {{--</div>--}}

            {{--{!! Form::close() !!}--}}

{{--</div>--}}

        {{--<script>--}}
            {{--window.ParsleyConfig = {--}}
                {{--errorsWrapper: '<div></div>',--}}
                {{--errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',--}}
                {{--errorClass: 'has-error',--}}
                {{--successClass: 'has-success'--}}
            {{--};--}}
        {{--</script>--}}
        {{--<script src="http://parsleyjs.org/dist/parsley.js"></script>--}}

        {{--<!-- Inlude Stripe.js -->--}}
        {{--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>--}}
        {{--<script>--}}
            {{--// This identifies your website in the createToken call below--}}
            {{--Stripe.setPublishableKey('{!! env('STRIPE_PK') !!}');--}}

            {{--jQuery(function($) {--}}
                {{--$('#payment-form').submit(function(event) {--}}
                    {{--var $form = $(this);--}}

                    {{--// Before passing data to Stripe, trigger Parsley Client side validation--}}
                    {{--$form.parsley().subscribe('parsley:form:validate', function(formInstance) {--}}
                        {{--formInstance.submitEvent.preventDefault();--}}
                        {{--return false;--}}
                    {{--});--}}

                    {{--// Disable the submit button to prevent repeated clicks--}}
                    {{--$form.find('#submitBtn').prop('disabled', true);--}}

                    {{--Stripe.card.createToken($form, stripeResponseHandler);--}}

                    {{--// Prevent the form from submitting with the default action--}}
                    {{--return false;--}}
                {{--});--}}
            {{--});--}}

            {{--function stripeResponseHandler(status, response) {--}}
                {{--var $form = $('#payment-form');--}}

                {{--if (response.error) {--}}
                    {{--// Show the errors on the form--}}
                    {{--$form.find('.payment-errors').text(response.error.message);--}}
                    {{--$form.find('.payment-errors').addClass('alert alert-danger');--}}
                    {{--$form.find('#submitBtn').prop('disabled', false);--}}
                    {{--$('#submitBtn').button('reset');--}}
                {{--} else {--}}
                    {{--// response contains id and card, which contains additional card details--}}
                    {{--var token = response.id;--}}
                    {{--// Insert the token into the form so it gets submitted to the server--}}
                    {{--$form.append($('<input type="hidden" name="stripeToken" />').val(token));--}}
                    {{--// and submit--}}
                    {{--$form.get(0).submit();--}}
                {{--}--}}
            {{--};--}}
        {{--</script>--}}
{{--</body>--}}

{{--</html>--}}


{!! Form::open(['url' => url('registerOrder'),'method' => 'post',]) !!}
    <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_RRDcRey63aipkR9UbaPDPRTo"
            data-amount="999"
            data-name="Demo Site"
            data-description="Widget"
            data-image="/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-zip-code="true"
            data-currency="eur">
    </script>
{!! Form::close() !!}