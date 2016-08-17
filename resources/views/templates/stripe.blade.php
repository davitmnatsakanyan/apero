<script type="text/ng-template" id="myModalContent.html">

    <div class="modal-header">
        <h3 class="modal-title">Enter cart information</h3>
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
            <div class="form-group ">
                <label>Cared Number</label>
            <input ng-model="number" placeholder="4242 4242 4242 4242" payments-format="card" payments-validate="card"/>
                </div>
            <div class="form-group ">
                <label>Expiration</label>
            <input ng-model="expiry" placeholder="12/2017" payments-format="expiry" payments-validate="expiry"/>
                </div>
            <div class="form-group ">
                <label>CVC</label>
            <input ng-model="cvc" placeholder="1234" payments-format="cvc"  payments-validate="cvc"/>
                </div>
            <button type="submit">Submit</button>
        </form>
    </div>


</script>