<div ng-include='"templates/nav.blade.php"'></div>
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

                        <div ng-include='"templates/caterer/account/_navbar.blade.php"'></div>
                        <div data-ng-controller="CatererProductsController">
                            <div class="col-sm-7 col-md-8">
                                <div ng-if="product.subproducts.length">
                                    <div class="package-tab">
                                <uib-tabset active="activeJustified" justified="true" class="mt20">
                                    <uib-tab index="0" heading="Common information">
                                        <div ng-include='"templates/caterer/product/single/items/showCommonInformation.blade.php"'></div>
                                    </uib-tab>
                                    <uib-tab index="1" heading="Subroducts">
                                        <div ng-include='"templates/caterer/product/single/items/showSubproducts.blade.php"'></div>
                                    </uib-tab>
                                </uib-tabset>
                                        </div>
                                </div>
                                <div ng-if="!product.subproducts.length">
                                    <div ng-include='"templates/caterer/product/single/items/showCommonInformation.blade.php"'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div ng-include='"templates/footer.blade.php"'></div>