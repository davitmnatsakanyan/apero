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
                                <div ng-if="product.subproducts.length">
                                    <div class="package-tab">
                                <uib-tabset active="activeJustified" justified="true" class="mt20">
                                    <uib-tab index="0" heading="Common information">
                                        @include('templates/caterer/product/single/items/showCommonInformation')
                                    </uib-tab>
                                    <uib-tab index="1" heading="Subroducts">
                                        @include('templates/caterer/product/single/items/showSubproducts')
                                    </uib-tab>
                                </uib-tabset>
                                        </div>
                                </div>
                                <div ng-if="!product.subproducts.length">
                                    @include('templates/caterer/product/single/items/showCommonInformation')
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