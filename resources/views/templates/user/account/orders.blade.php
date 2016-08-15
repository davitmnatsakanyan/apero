<div ng-include='"templates/nav.blade.php"'></div>

<!-- Content -->
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-xs-12 hh">
                    <div class="inner-cater-txt">
                        <p class="mb10">Hello <% user.name %></p>
                    </div>
                </div>
                <div class="col-xs-12">

                    <div class="inner-cater">
                        <div class="row no-margin">

                            <div ng-include='"templates/user/account/_navbar.blade.php"'></div>

                            <div class="col-sm-7 col-md-8 cater-right-text" ng-if="!orders.length">
                                <p>Leider keine Bestellungen vorhanden</p>
                                <div class="product-btn product-button">
                                   <a href="#/caterers">Produkte Bearbeitem</a>
                                </div>
                            </div>

                            <div class="col-sm-7 col-md-8 company-apero company-apero-company" ng-if="orders.length">
                                <div  class = "pt20" data-ng-controller="UserOrdersController">
                                    <div ng-repeat="todo in filteredTodos">
                                        <div class="adress fl">
                                            <a href="<% '#/user/orders/' + todo.order_id %>">
                                                <div class="numb1">
                                                    <span class="cg4 fz20 fmlbold"><% todo.num %></span>
                                                </div>
                                            </a>
                                            <div class="numb1-txt">
                                                <p class=" no-padding fmlreg fz20 cg2"><% todo.address %></p>
                                                <small class="cg3 fmlreg fz14">Price:
                                                <span class="numb2">
                                                    <% todo.price %>
                                                </span>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="username-btn fl">
                                            <p class="cg5 fmlreg fz16 shipping dib"><% todo.status %></p>
                                        </div>
                                        <div class="clear-both"></div>
                                        <div class="border-bottom">
                                        </div><!--end-->
                                    </div>

                                    <ul uib-pagination ng-model="currentPage"
                                        total-items="todos.length"
                                        max-size="maxSize"
                                        boundary-links="true"
                                        items-per-page="numPerPage"
                                        ng-show="currentPage">
                                    </ul>
                                </div>
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
