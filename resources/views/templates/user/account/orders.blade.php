<div ng-include='"templates/nav.blade.php"'></div>

<!-- Content -->
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-xs-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello  “Usernam”</p>
                    </div>
                </div>
                <div class="col-xs-12  ">

                    <div class="inner-cater">
                        <div class="row">

                            <div ng-include='"templates/user/account/_navbar.blade.php"'></div>

                            <div class="col-sm-7 col-md-8 cater-right-text" ng-if = "!orders.length" >
                                <p>Leider keine Bestellungen vorhanden</p>
                                <div class="product-btn">
                                    <input type="submit" value="Produkte Bearbeitem"/>
                                </div>
                            </div>

                            <div class="col-sm-7 col-md-8 company-apero company-apero-company" ng-if = "orders.length">
                                <div class="company-title">
                                    <p class="fz28 fmlreg cg1 db">Meine Bestellungen</p>
                                </div>
                                {{--<div ng-repeat="order in orders track by order.id">--}}
                                {{--<div class="adress fl" >--}}
                                    {{--<div class="numb1"><span class="cg4 fz28 fmlbold"><% $index+1 %></span></div>--}}
                                    {{--<div class="numb1-txt">--}}
                                        {{--<p class="fmlreg fz20 cg2"><% order.delivery_zip + " "--}}
                                                                      {{--+ order.delivery_address + ", "--}}
                                                                      {{--+ order.delivery_city + ", "--}}
                                                                      {{--+ order.delivery_country--}}
                                                                    {{--%></p>--}}
                                        {{--<small class="cg3 fmlreg fz14"><% order.delivery_time %></small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="pricessing fl">--}}
                                    {{--<select ng-options="status.name for status in statuses track by status.name" ng-model="order.status"></select>--}}
                                {{--</div>--}}
                                {{--<div class="clear-both"></div>--}}
                                {{--<div class="border-bottom">--}}
                                {{--</div><!--end-->--}}
                                {{--</div>--}}



                                <div>
                                    <h4>Default</h4>

                                    <ul>
                                        <li ng-repeat="todo in filteredTodos"><% todo.text %></li>
                                    </ul>

                                    <ul uib-pagination ng-model="currentPage"
                                        total-items="todos.length"
                                        max-size="maxSize"
                                        boundary-links="true"> ></ul>

                                </div>

                                {{--<div class="circles">--}}
                                    {{--<ul class="clear-fix fr">--}}
                                        {{--<li class="fl"><a href="#" class="dib active"></a></li>--}}
                                        {{--<li class="fl"><a href="#" class="dib"></a></li>--}}
                                        {{--<li class="fl"><a href="#" class="dib"></a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}


                                <h1>Todos</h1>
                                {{--<h4>{{todos.length}} total</h4>--}}
                                {{--<ul>--}}
                                    {{--<li ng-repeat="todo in filteredTodos">{{todo.text}}</li>--}}
                                {{--</ul>--}}
                                <% todos.length %>
                                <pagination
                                        ng-model="currentPage"
                                        total-items="todos.length"
                                        max-size="maxSize"
                                        boundary-links="true">
                                </pagination>
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