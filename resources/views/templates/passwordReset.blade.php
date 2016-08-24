@include('templates/nav')
<!-- Content -->
<section id="content">

    <!-- Section Filter -->
    <div class="section-filter">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 passwordReset">
                    <h1 class="fz40 font-family-class"> Reset password </h1>
                        <div class="apero-anbieter clearfix" ng-init="initFunction()">

                            <form method="post" id="changePassword" class="change-form">

                                <div class="info-box">
                                    <label for="password" class="title fmlbold fz17 lable-width">New password</label>
                                    <input type="password" class="text fmlreg fz13 input-width" id="password"
                                           ng-model="password"/>
                                </div><!--end-->

                                <div class="info-box">
                                    <label for="confirm_password" class="title fmlbold fz17 lable-width">Confirm
                                        password</label>
                                    <input type="password" class="text fmlreg fz13 input-width" id="confirm_password"
                                           ng-model="password_confirmation"/>
                                </div>

                                <input type="hidden" id="email" ng-model="email"/>
                                <input type="hidden" id="role" ng-model="role"/>


                            </form>
                            <div class="clear-both"></div>
                            <div class="profile-border-box">
                                <div class="profil-border"></div>
                            </div>
                            <div class="save-btn">
                                <input type="submit" class="fmlreg fz25" ng-click="changePassword()"
                                       form="changePassword" value="Save"/>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <!-- End Section Filter -->

</section>
<!-- End Content -->
@include('templates/footer')