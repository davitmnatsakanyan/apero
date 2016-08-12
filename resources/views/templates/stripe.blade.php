<script type="text/ng-template" id="myModalContent.html">

    <div class="modal-header">
        <h3 class="modal-title">I'm a modal!</h3>
    </div>
    <div class="modal-body">
        {{--<form action="" method="GET" id="payment-form">--}}
            {{--<span class="payment-errors"></span>--}}

            {{--<div class="form-row">--}}
                {{--<label>--}}
                    {{--<span>Card Number</span>--}}
                    {{--<input type="text" size="20" data-stripe="number">--}}
                {{--</label>--}}
            {{--</div>--}}

            {{--<div class="form-row">--}}
                {{--<label>--}}
                    {{--<span>Expiration (MM/YY)</span>--}}
                    {{--<input type="text" size="2" data-stripe="exp_month">--}}
                {{--</label>--}}
                {{--<span> / </span>--}}
                {{--<input type="text" size="2" data-stripe="exp_year">--}}
            {{--</div>--}}

            {{--<div class="form-row">--}}
                {{--<label>--}}
                    {{--<span>CVC</span>--}}
                    {{--<input type="text" size="4" data-stripe="cvc">--}}
                {{--</label>--}}
            {{--</div>--}}

            {{--<div class="form-row">--}}
                {{--<label>--}}
                    {{--<span>Billing Zip</span>--}}
                    {{--<input type="text" size="6" data-stripe="address_zip">--}}
                {{--</label>--}}
            {{--</div>--}}

            {{--<div class="modal-footer">--}}
                {{--<button class="btn btn-primary" type="submit" ng-click="ok()">OK</button>--}}
                {{--<button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>--}}
                {{--<input type="submit" class="submit btn btn-primary" value="Submit Payment">--}}
            {{--</div>--}}

        {{--</form>--}}

        <form stripe-form="stripeCallback">
            <input ng-model="number" placeholder="Card Number" />
            <input ng-model="expiry" placeholder="Expiration" />
            <input ng-model="cvc" placeholder="CVC" />
            <button type="submit">Submit</button>
        </form>
    </div>


</script>