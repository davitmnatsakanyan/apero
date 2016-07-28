<div ng-include='"templates/nav.blade.php"'></div>

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
                        <div class="row">

                            <div ng-include='"templates/user/account/_navbar.blade.php"'></div>

                            <div class="col-sm-7 col-md-8 company-apero company-apero-company" ng-if="order">
                            <div class="company-title-username">
                                <p class="fz28 fmlreg cg1 db">Order id: <% order.id %></p>
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


{{--<div class="pricessing fl">--}}
{{--<select ng-options="status.name for status in statuses track by status.name" ng-model="order.status"></select>--}}
{{--<% todo.status.name %>--}}
{{--</div>--}}