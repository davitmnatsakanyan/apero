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
                        <div data-ng-controller="EditProductController">
                            <div class="col-sm-7 col-md-8" ng-init="getPrDts()">
                                <div>
                                    <uib-tabset active="activeJustified"  class="profile-tab" justified="true">
                                        <uib-tab index="0" heading="Common information">
                                            <div ng-include='"templates/caterer/product/single/items/editCommonInformation.blade.php"'></div>
                                        </uib-tab>
                                        <uib-tab index="1" heading="Subroducts" ng-if="product.subproducts.length">
                                            <div ng-include='"templates/caterer/product/single/items/editSubproducts.blade.php"'></div>
                                        </uib-tab>
                                        <uib-tab index="2" heading="Add subproducts">
                                            <div ng-include='"templates/caterer/product/single/items/editCustomize.blade.php"'></div>
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
<div ng-include='"templates/footer.blade.php"'></div>