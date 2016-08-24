@include('templates/nav')
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-sm-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello <% caterer.company %></p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="inner-cater">

                        @include('templates/caterer/account/_navbar')
                        <div data-ng-controller="EditProductController">
                            <div class="col-sm-7 col-md-8" ng-init="getPrDts()">
                                <div class="package-tab">
                                    <uib-tabset active="activeJustified"  class="profile-tab" justified="true">
                                        <uib-tab index="0" heading="Common information">
                                            @include('templates/caterer/product/single/items/editCommonInformation')
                                        </uib-tab>
                                        <uib-tab index="1" {{--class='order-tab'--}} heading="Subroducts" ng-if="product.subproducts.length">
                                            @include('templates/caterer/product/single/items/editSubproducts')
                                        </uib-tab>
                                        <uib-tab index="2"  {{--class='order-tab'--}} heading="Add subproducts">
                                            @include('templates/caterer/product/single/items/editCustomize')
                                        </uib-tab>
                                    </uib-tabset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('templates/footer')