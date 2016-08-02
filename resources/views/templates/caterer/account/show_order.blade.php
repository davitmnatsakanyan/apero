<div ng-include='"templates/nav.blade.php"'></div>

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
                        <div class="row">

                            <div ng-include='"templates/caterer/account/_navbar.blade.php"'></div>

                            <div class="col-sm-7 col-md-8 company-apero company-apero-company" ng-if="order">
                                <uib-tabset active="activeJustified" justified="true" class="order-padding">
                                    <uib-tab index="0" heading="Common information">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>ID</th>
                                                    <td><% order.id %></td>
                                                </tr>
                                                <tr>
                                                    <th>User</th>
                                                    <td><% order.user.name %></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td><% order.email %></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td><% order.phone %></td>
                                                </tr>
                                                <tr>
                                                    <th>Mobile</th>
                                                    <td><% order.mobile %></td>
                                                </tr>

                                                <tr>
                                                    <th> Address</th>
                                                    <td> <% order.delivery_address + ", " . order.delivery_zip + ", " +
                                                        order.delivery_city + ", " + order.delivery_country%>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th> Delivery Time</th>
                                                    <td> <% order.delivery_time%></td>
                                                </tr>
                                                <tr>
                                                    <th>Total cost</th>
                                                    <td> <% order.total_cost %></td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Type</th>
                                                    <td><% order.payment_type %></td>
                                                </tr>
                                                <tr ng-if="order.billing_address">
                                                    <th>Billing Address</th>
                                                    <td><% order.billing_address %></td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td><% order.status%></td>
                                                </tr>
                                                <tr>
                                                    <th>Comment</th>
                                                    <td><% order.comment ? order.comment:'No Comments' %></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </uib-tab>
                                    <uib-tab index="1" heading="Products">
                                        <div data-ng-controller="CatererOrdersController" ng-if="order.products.length">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th> Product name</th>
                                                <th> Amount</th>
                                                <th> Comment</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="product in filteredProducts track by $index">
                                                    <td><% (currentProductPage-1) * numPerPageForProducts+$index+1 %></td>
                                                    <td><% product.subproduct ? product.name + " " + product.subproduct.name: product.name %></td>
                                                    <td><% product.pivot.amount %></td>
                                                    <td><% product.pivot.description ? product.pivot.description : 'No Comment' %> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <ul uib-pagination ng-model="currentProductPage"
                                            total-items="order.products.length"
                                            max-size="productsMaxSize"
                                            boundary-links="true"
                                            items-per-page="numPerPageForProducts"
                                            ng-show="currentProductPage">
                                        </ul>
                                            </div>
                                        <div ng-if="!order.products.length" class="company-title">
                                            <p class="fz28 fmlreg cg1 db">No products</p>
                                        </div>
                                    </uib-tab>
                                    <uib-tab index="2" heading="Packages">
                                        <div data-ng-controller="CatererOrdersController" ng-if="order.packages.length">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th> Package name</th>
                                                <th> Amount</th>
                                                <th> Comment</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="package in filteredPackage track by $index">
                                                <td><% (currentPackagePage-1) * numPerPageForPackages+$index+1 %></td>
                                                <td><% package.name %></td>
                                                <td><% package.pivot.amount %></td>
                                                <td><% package.pivot.description ? package.pivot.description : 'No Comment' %> </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <ul uib-pagination ng-model="currentPackagePage"
                                            total-items="order.packages.length"
                                            max-size="packagesMaxSize"
                                            boundary-links="true"
                                            items-per-page="numPerPageForPackages"
                                            ng-show="currentPackagePage">
                                        </ul>
                                            </div>

                                        <div ng-if="!order.packages.length" class="company-title">
                                            <p class="fz28 fmlreg cg1 db">No packages</p>
                                        </div>
                                    </uib-tab>
                                </uib-tabset>


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


{{--<div class="pricessing fl">--}}
{{--<select ng-options="status.name for status in statuses track by status.name" ng-model="order.status"></select>--}}
{{--<% todo.status.name %>--}}
{{--</div>--}}