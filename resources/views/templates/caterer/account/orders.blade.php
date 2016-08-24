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

                            <div class="col-sm-7 col-md-8 cater-right-text" ng-if="!orders.length">
                                <p>Leider keine Bestellungen vorhanden</p>
                                <div class="product-btn">
                                    <input type="submit" value="Produkte Bearbeitem"/>
                                </div>
                            </div>
                            <div class="col-sm-7 col-md-8 company-apero company-apero-company" ng-if="orders.length">
                                <div data-ng-controller="CatererOrdersController">
                                    <div class="company-title">
                                        <p class="fz28 fmlreg cg1 db">Meine Bestellungen</p>
                                    </div>
                                    <div ng-repeat="order in filteredTodos">
                                        <div class="adress fl">
                                            <div class="numb1">
                                            <span class="cg4 fz28 fmlbold">
                                                <a ng-href="#/caterer/orders/<% order.order_id %>">
                                                <% order.num %>
                                                </a>
                                            </span>
                                            </div>
                                            <div class="numb1-txt">
                                                <p class="fmlreg fz20 cg2"><% order.address %></p>
                                                <small class="cg3 fmlreg fz14"><% order.time %></small>
                                            </div>
                                        </div>

                                        <div class="pricessing fl" ng-if="order.status.name!='Not Accepted'">
                                            <select ng-options="status.name for status in statuses track by status.name" ng-model="order.status" ng-change ="changeSelect(order.order_id)"></select>
                                        </div>

                                            <div class="order fl" ng-if="order.status.name ==='Not Accepted'" ng-click="acceptOrder(order.order_id)">
                                                <input type="submit" value="Accept order"/>
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

</main>
<!-- End Content -->
@include('templates/footer')