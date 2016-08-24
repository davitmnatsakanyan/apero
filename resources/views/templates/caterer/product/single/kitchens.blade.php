@include('templates/nav')
<!-- Content -->
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-xs-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello <% caterer.company %></p>
                    </div>
                </div>
                <div class="col-xs-12  ">

                    <div class="inner-cater">
                        <div class="row no-margin">

                            @include('templates/caterer/account/_navbar')

                            <div class="col-sm-7 col-md-8 company-apero company-apero-company">
                                <div data-ng-controller="CatererProductsController">
                                    <div class="bestellen1">
                                    <a  class="add-button" href="#/caterer/product/add">Add product</a>
                                        </div>
                                    <div ng-repeat="kitchen in filteredKitchens">
                                        <div class="adress fl">
                                            <div class="numb1">
                                            <span class="cg4 fz28 fmlbold">
                                                <a ng-href="#/caterer/<% kitchen.id %>/menus">
                                                    <% (currentKitchensPage-1)*numPerPageForKitchens+$index+1 %>
                                                </a>
                                            </span>
                                            </div>
                                            <div class="numb1-txt">
                                                <p class="fmlreg fz20 cg2 mt6"> <% kitchen.name %></p>
                                            </div>
                                        </div>

                                        <div class="clear-both"></div>
                                        <div class="border-bottom">
                                        </div><!--end-->
                                    </div>
                                    <ul uib-pagination ng-model="currentKitchensPage"
                                        total-items="kitchens.length"
                                        max-size="kitchensMaxSize"
                                        boundary-links="true"
                                        items-per-page="numPerPageForKitchens"
                                        ng-show="currentKitchensPage">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
<!-- End Content -->
@include('templates/footer')