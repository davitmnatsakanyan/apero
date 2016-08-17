<div ng-include='"templates/nav.blade.php"'></div>
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-sm-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello <% caterer.name %></p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="inner-cater">
                        <div class="row">
                        <div ng-include='"templates/caterer/account/_navbar.blade.php"'></div>
                        <div data-ng-controller="CatererProductsController">
                            <div class="col-sm-7 col-md-8">
                                <a  class="add-button" href="#/caterer/product/add">Add product</a>
                                <div class="main-product-box" data-ng-repeat="product in filteredProducts">
                                    <div>
                                        <img class="product-list-img" src="images/products/<% product.avatar %>" , alt="Mountain View"/>
                                    </div>
                                    {{--<div class="main-product fl"></div>--}}
                                    <div class="product-txt fl">
                                        <p class="fmlreg fz20 cg1 title">
                                            <% product.name %>
                                        </p>
                                        <p class="fmlreg fz13 text">
                                            Price:<% product.price %>
                                        </p>
                                    </div>
                                    <div class="icons-box">
                                        <ul class="product-icons dib clear-fix">
                                            <li class="fl"><a href="#/caterer/product/show/<% product.id %>" class="eye-icon"></a></li>
                                            <li class="fl"><a href="#/caterer/product/edit/<% product.id %>" class="pencil-red-icon"></a></li>
                                            <li class="fl"><a ng-click="deleteProduct(product.id)" class="red-times-icon"></a></li>
                                        </ul>
                                    </div>
                                    <div class="clear-both"></div>
                                </div><!--end-->


                                <ul uib-pagination ng-model="currentProductsPage"
                                    total-items="products.length"
                                    max-size="productsMaxSize"
                                    boundary-links="true"
                                    items-per-page="numPerPageForProducts"
                                    ng-show="currentProductsPage">
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
<div ng-include='"templates/footer.blade.php"'></div>