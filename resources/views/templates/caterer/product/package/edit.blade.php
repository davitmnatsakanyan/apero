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
                        <div data-ng-controller="CatererPackageController">
                            <div class="col-sm-7 col-md-8" ng-init="getPackageDatas()">
                                <div class="package-tab">
                                <uib-tabset active="activeJustified"  class="profile-tab" justified="true">
                                    <uib-tab index="0" heading="Common information">
                                        @include('templates/caterer/product/package/items/editCommonInformation')
                                    </uib-tab>
                                    <uib-tab {{--class='order-tab'--}} index="1" heading="Products">
                                        <div  ng-include='"templates/caterer/product/package/items/editProducts')
                                    </uib-tab>
                                    <uib-tab {{--class='order-tab'--}} index="2" heading="Add Products">
                                        @include('templates/caterer/product/package/items/addProduct')
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