@include('templates/nav')
<!-- Content -->
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-sm-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello <% caterer.company %></p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="inner-cater">

                        @include('templates/caterer/account/_navbar')

                        <div class="col-sm-7 col-md-8">
                            <div class="package-tab">
                                <uib-tabset active="activeJustified" class="profile-tab" justified="true">
                                    <uib-tab index="0" heading="Common information" class="profile-tab-1">
                                        <div class="tab-content" ng-init="getAccount()">
                                            <div role="tabpanel" class="tab-pane active" id="home profile-tabs">
                                                <form method="post">
                                                    <div class="profil-form fl">
                                                        <div class="info-box">
                                                            <label for="company"
                                                                   class="title fmlbold fz15">Company</label>
                                                            <input type="text" class="text fmlreg fz13" id="company"
                                                                   ng-model="caterer.company"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="address"
                                                                   class="title fmlbold fz15">Address</label>
                                                            <input type="text" class="text fmlreg fz13" id="address"
                                                                   ng-model="caterer.address"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="pobox" class="title fmlbold fz15">Pobox</label>
                                                            <input type="text" class="text fmlreg fz13" id="pobox"
                                                                   ng-model="caterer.pobox"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="zip" class="title fmlbold fz15">Zip</label>

                                                            <ui-select ng-model="selectedZip" class="fmlreg fz13 mb1 order1"
                                                                       on-select="selectZip($select.selected, $model)">
                                                                <ui-select-match class="select-zip"><%
                                                                    $select.selected.ZIP + " " +
                                                                    $select.selected.city %>
                                                                </ui-select-match>
                                                                <ui-select-choices
                                                                        repeat="zip in zips track by zip.id">
                                                                    <% zip.ZIP+" " +zip.city %>
                                                                </ui-select-choices>
                                                            </ui-select>
                                                        </div><!--end-->

                                                        <div class="info-box">


                                                            <div class="col-sm-6 no-padding">
                                                                <label for="products_origin" class="title fmlbold fz15">Products
                                                                    Origin</label></div>
                                                            <div class="col-sm-6 no-padding ml9">
                                                                <textarea rows="3" cols="50"
                                                                          ng-model="caterer.products_origin"
                                                                          class="text fmlreg fz13"></textarea>
                                                            </div>
                                                            {{--<input type="text" class="text fmlreg fz13" id="zip" ng-model="caterer.products_origin"/>--}}
                                                        </div><!--end-->


                                                    </div><!--end-->

                                                    <div class="profil-form fl">
                                                        <div class="info-box">
                                                            <label for="city"
                                                                   class="title fmlbold fz15">City</label>
                                                            <input type="text" class="text fmlreg fz13" id="city"
                                                                   ng-model="caterer.city"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="phone"
                                                                   class="title fmlbold fz15">Phone</label>
                                                            <input type="text" class="text fmlreg fz13" id="phone"
                                                                   ng-model="caterer.phone"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="email"
                                                                   class="title fmlbold fz15">E-mail</label>
                                                            <input type="email" class="text fmlreg fz13" id="email"
                                                                   ng-model="caterer.email"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="country"
                                                                   class="title fmlbold fz15">Country</label>
                                                            <ui-select ng-model="selectedCountry"
                                                                       class="fmlreg fz13 mb1 order1"
                                                                       on-select="selectCountry($select.selected, $model)">
                                                                <ui-select-match class="select-zip"><%
                                                                    $select.selected.name %>
                                                                </ui-select-match>
                                                                <ui-select-choices
                                                                        repeat="country in countries track by country.id">
                                                                    <% country.name %>
                                                                </ui-select-choices>
                                                            </ui-select>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <div class="col-sm-6 no-padding">
                                                            <label for="description" class="title fmlbold fz15">Description</label>
                                                              </div>
                                                            <div class="col-sm-6 no-padding ml9">
                                                                <textarea rows="3" cols="50"
                                                                          ng-model="caterer.description"
                                                                          class="text fmlreg fz13"></textarea>
                                                                </div>
                                                            {{--<input type="textarea"  class="text fmlreg fz13" id="description" ng-model="caterer.description"/>--}}
                                                        </div><!--end-->


                                                    </div><!--end-->
                                                </form>
                                                <div class="clear-both"></div>
                                                <div class="profile-border-box">
                                                    <div class="profil-border"></div>
                                                </div>

                                                {{--<button ng-click="registerInStripe()">Button</button>--}}
                                                <div class ="profile-page-btn">
                                                <div class="save-btn">
                                                    <input type="submit" value="Save" class="fmlreg fz25"
                                                           ng-click="updateCaterer()"/>
                                                </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </uib-tab>
                                    <uib-tab index="1" heading="Contact person" class="profile-tab-1">
                                        <form action="#" method="post">
                                            <div class="profil-form fl">
                                                <div class="info-box">
                                                    <label for="cp_title" class="title fmlbold fz15">Title</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_title"
                                                           ng-model="contact_person.title"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_prename" class="title fmlbold fz15">Prename</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_prename"
                                                           ng-model="contact_person.prename"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_name" class="title fmlbold fz15">Name</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_name"
                                                           ng-model="contact_person.name"/>
                                                </div><!--end-->

                                            </div><!--end-->

                                            <div class="profil-form fl">
                                                <div class="info-box">
                                                    <label for="cp_mobile" class="title fmlbold fz15">Mobil</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_mobile"
                                                           ng-model="contact_person.mobile"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_phone" class="title fmlbold fz15">Phone</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_phone"
                                                           ng-model="contact_person.phone"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_email" class="title fmlbold fz15">E-mail</label>
                                                    <input type="email" class="text fmlreg fz13" id="cp_email"
                                                           ng-model="contact_person.email"/>
                                                </div><!--end-->

                                            </div><!--end-->
                                        </form>
                                        <div class="clear-both"></div>
                                        <div class="profile-border-box">
                                            <div class="profil-border"></div>
                                        </div>
                                        <div class="save-btn">
                                            <input type="submit" value="Save" class="fmlreg fz25"
                                                   ng-click="updateContactPerson()"/>
                                        </div>
                                    </uib-tab>
                                    <uib-tab index="2" heading="Delivery Area" class="profile-tab-1">
                                        @include('templates/caterer/account/items/deliveryArea')
                                    </uib-tab>
                                    <uib-tab index="3" heading="Kitchens"  class="profile-tab-1">
                                        @include('templates/caterer/account/items/kitchens')
                                    </uib-tab>
                                    </uib-tab>
                                    <uib-tab index="4" heading="Cooking Time" class="profile-tab-1">
                                        @include('templates/caterer/account/items/cookingTime')
                                    </uib-tab >
                                    <uib-tab index="5" heading="Change Password" class="profile-tab-1">
                                        @include('templates/caterer/account/items/changePassword')
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
@include('templates/footer')
