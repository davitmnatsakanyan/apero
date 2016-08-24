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
                        <div data-ng-controller="CatererProductsController">
                            <div class="col-sm-7 col-md-8">
                                <div ng-if="addingProduct.customize.length">
                                    <uib-tabset active="activeJustified" class="profile-tab" justified="true">
                                        <uib-tab index="0" heading="Common information">
                                            @include('templates/caterer/product/single/items/addCommonInformation')
                                        </uib-tab>
                                        <uib-tab index="1" heading="Subroducts">
                                            @include('templates/caterer/product/single/items/addSubproducts')
                                        </uib-tab>
                                    </uib-tabset>
                                </div>
                                <div ng-if="!addingProduct.customize.length">
                                    @include('templates/caterer/product/single/items/addCommonInformation')
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