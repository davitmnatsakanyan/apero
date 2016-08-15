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
                <div class="col-xs-12  ">

                    <div class="inner-cater">
                        <div class="row no-margin">

                            <div  ng-include='"templates/user/account/_navbar.blade.php"'></div>

                            <div class="col-sm-7 col-md-8">

                                <div class="company-title-username">
                                    <p class="fz28 fmlreg cg1 db">Meine Profile
                                        <a href="#/user/account/changePassword" class = "btn change-password">Change password</a>
                                    </p>
                                </div>

                                <form method="post" id="update_user">

                                    <div class="profil-form fl">

                                        <div class="info-box">
                                            <label for="title" class="title fmlbold fz17">Title</label>
                                            <input type="text" class="text fmlreg fz13" id="title"
                                                   ng-model="user.title"/>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="name" class="title fmlbold fz17">Name</label>
                                            <input type="text" class="text fmlreg fz13" id="name" ng-model="user.name"/>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="email" class="title fmlbold fz17">E-mail</label>
                                            <input type="email" class="text fmlreg fz13" id="email"
                                                   ng-model="user.email"/>
                                        </div>

                                        <div class="info-box">
                                            <label for="mobile" class="title fmlbold fz17">Mobile</label>
                                            <input type="text" class="text fmlreg fz13" id="mobile"
                                                   ng-model="user.mobile"/>
                                        </div>

                                        <div class="info-box">
                                            <label for="phone" class="title fmlbold fz17">Phone</label>
                                            <input type="text" class="text fmlreg fz13" id="phone"
                                                   ng-model="user.phone"/>
                                        </div><!--end-->

                                    </div><!--end-->

                                    <div class="profil-form fl">
                                        <div class="info-box">
                                            <label for="address" class="title fmlbold fz17">Address</label>
                                            <input type="text" class="text fmlreg fz13" id="address"
                                                   ng-model="user.address"/>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="pobox" class="title fmlbold fz17">Postfatch</label>
                                            <input type="text" class="text fmlreg fz13" id="pobox"
                                                   ng-model="user.pobox"/>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="zip" class="title fmlbold fz17">Zip</label>
                                            <ui-select ng-model="selectedZipCode"  class="text fmlreg fz13" on-select="selectZip($select.selected, $model)">
                                                <ui-select-match ><% $select.selected.name %></ui-select-match>
                                                <ui-select-choices repeat="zip in zip_codes track by zip.id">
                                                    <% zip.name %>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="city" class="title fmlbold fz17">City</label>
                                            <input type="text" class="text fmlreg fz13" id="city" ng-model="user.city"/>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="country" class="title fmlbold fz17">Country</label>
                                            <ui-select ng-model="selectedCountry"  class="text fmlreg fz13" on-select="selectCountry($select.selected, $model)">
                                                <ui-select-match ><% $select.selected.name %></ui-select-match>
                                                <ui-select-choices repeat="country in countries track by country.id">
                                                    <% country.name %>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div><!--end-->

                                    </div><!--end-->
                                </form>
                                <div class="clear-both"></div>
                                <div class="profile-border-box">
                                    <div class="profil-border"></div>
                                </div>
                                <div class="save-btn">
                                    <input type="submit"  class="fmlreg fz25" ng-click="update(user)" form="update_user"  value="Save" />
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