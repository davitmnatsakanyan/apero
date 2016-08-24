@include('templates/nav')

<!-- Content -->
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-xs-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello <% user.name %></p>
                    </div>
                </div>
                <div class="col-xs-12  ">

                    <div class="inner-cater">
                        <div class="row no-margin">

                            @include('templates/user/account/_navbar')

                            <div class="col-sm-7 col-md-8 company-apero company-apero-company" ng-if="order">
                                <div class="company-title-username">
                                    <p class="fz28 fmlreg cg1 db">Status: <% order.status %></p>
                                </div>

                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Caterer</th>
                                        <td><% order.caterer.company %></td>
                                    </tr>
                                    <tr>
                                        <th>Delivery address</th>
                                        <td><% order.delivery_address + ","  + order.delivery_city %></td>
                                    </tr>
                                    <tr>
                                        <th> Cost</th>
                                        <td><% order.total_cost %></td>
                                    </tr>
                                    <tr>
                                        <th>Ordering time</th>
                                        <td><% order.created_at %></td>
                                    </tr>
                                    <tr>
                                        <th>Products</th>
                                        <td>
                                            <span ng-repeat="product in order.products"> <% product.name %>,</span>
                                            <span ng-repeat="package in order.packages"> <% package.name %>,</span></td>
                                    </tr>
                                    </tbody>
                                </table>
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


{{--<div class="pricessing fl">--}}
{{--<select ng-options="status.name for status in statuses track by status.name" ng-model="order.status"></select>--}}
{{--<% todo.status.name %>--}}
{{--</div>--}}