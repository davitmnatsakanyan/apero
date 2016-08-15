<div ng-include='"templates/nav.blade.php"'></div>
<!-- Content -->
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-xs-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello “Catering - Company”</p>
                    </div>
                </div>
                <div class="col-xs-12  ">

                    <div class="inner-cater">
                        <div class="row no-margin">

                            <div ng-include='"templates/caterer/account/_navbar.blade.php"'></div>

                            <div class="col-sm-7 col-md-8 company-apero company-apero-company">
                                <div data-ng-controller="CatererProductsController">

                                    <a  class="add-button" href="#/caterer/product/add">Add product</a>

                                    <div ng-repeat="menu in filteredMenus">
                                        <div class="adress fl">
                                            <div class="numb1">
                                            <span class="cg4 fz28 fmlbold">
                                                <a ng-href="#/caterer/<% kitchen_id %>/<% menu.id %>/products">
                                                    <% (currentMenusPage-1)*numPerPageForMenus+$index+1 %>
                                                </a>
                                            </span>
                                            </div>
                                            <div class="numb1-txt">
                                                <p class="fmlreg fz20 cg2"> <% menu.name %></p>
                                            </div>
                                        </div>

                                        <div class="clear-both"></div>
                                        <div class="border-bottom">
                                        </div><!--end-->
                                    </div>
                                    <ul uib-pagination ng-model="currentMenusPage"
                                        total-items="menus.length"
                                        max-size="menusMaxSize"
                                        boundary-links="true"
                                        items-per-page="numPerPageForMenus"
                                        ng-show="currentMenusPage">
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
<div ng-include='"templates/footer.blade.php"'></div>