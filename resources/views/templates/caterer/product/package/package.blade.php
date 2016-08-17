<div ng-include='"templates/nav.blade.php"'></div>
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-sm-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello “Catering - Company”</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="inner-cater">

                        <div ng-include='"templates/caterer/account/_navbar.blade.php"'></div>
                        <div data-ng-controller="CatererPackageController">
                            <div class="col-sm-7 col-md-8" ng-init="getPackageDatas()">
                                <a href="#/caterer/packages/add" class="add-button">Add package</a>
                                <div class="main-product-box" data-ng-repeat="package in filteredPackages">
                                    <div class="main-product fl"></div>
                                    <div class="product-txt fl no-margin-top">
                                        <p class="fmlreg fz20 cg1 title no-margin-bottom">
                                            <% package.name %>
                                            <span><%(currentPackagePage-1)*numPerPageForPackages +$index+1 %></span>
                                        </p>
                                        <p class="fmlreg fz13 text">
                                           Price:<% package.price %>
                                        </p>
                                    </div>
                                    <div class="icons-box">
                                        <ul class="product-icons dib clear-fix">
                                            <li class="fl"><a href="#/caterer/packages/show/<% package.id %>" class="eye-icon"></a></li>
                                            <li class="fl"><a href="#/caterer/packages/edit/<% package.id %>" class="pencil-red-icon"></a></li>
                                            <li class="fl"><a  class="red-times-icon" ng-click="deletePackage(package.id)"></a></li>
                                        </ul>
                                    </div>
                                    <div class="clear-both"></div>
                                </div><!--end-->


                                <ul uib-pagination ng-model="currentPackagePage"
                                    total-items="packages.length"
                                    max-size="packagesMaxSize"
                                    boundary-links="true"
                                    items-per-page="numPerPageForPackages"
                                    ng-show="currentPackagePage">
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div ng-include='"templates/footer.blade.php"'></div>