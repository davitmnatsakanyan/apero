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

                            <div class="col-sm-7 col-md-8">

                                <div class="company-title-username">
                                    <p class="fz28 fmlreg cg1 db">Change Password
                                    </p>
                                </div>

                                <form method="post" id="changePassword">

                                        <div class="info-box">
                                            <label for="old_password" class="title fmlbold fz17 lable-width add-product-label">Old Password</label>
                                            <input type="password" class="text fmlreg fz13 input-width" id="old_password"
                                                   ng-model="data.old_password"/>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="password" class="title fmlbold fz17 lable-width add-product-label">New password</label>
                                            <input type="password" class="text fmlreg fz13 input-width" id="password" ng-model="data.password"/>
                                        </div><!--end-->

                                        <div class="info-box">
                                            <label for="confirm_password" class="title fmlbold fz17 lable-width add-product-label">Confirm password</label>
                                            <input type="password" class="text fmlreg fz13 input-width" id="confirm_password"
                                                   ng-model="data.password_confirmation"/>
                                        </div>


                                </form>
                                <div class="clear-both"></div>
                                <div class="profile-border-box">
                                    <div class="profil-border"></div>
                                </div>
                                <div class="save-btn">
                                    <input type="submit"  class="fmlreg fz25" ng-click="changePassword()" form="changePassword"  value="Save" />
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
@include('templates/footer')