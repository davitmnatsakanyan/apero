
<form method="post" id="changePassword" class = "change-form">

    <div class="info-box">
        <label for="old_password" class="title fmlbold fz17 lable-width">Old Password</label>
        <input type="password" class="text fmlreg fz13 input-width" id="old_password"
               ng-model="changePasswordData.old_password"/>
    </div><!--end-->

    <div class="info-box">
        <label for="password" class="title fmlbold fz17 lable-width">New password</label>
        <input type="password" class="text fmlreg fz13 input-width" id="password" ng-model="changePasswordData.password"/>
    </div><!--end-->

    <div class="info-box">
        <label for="confirm_password" class="title fmlbold fz17 lable-width">Confirm password</label>
        <input type="password" class="text fmlreg fz13 input-width" id="confirm_password"
               ng-model="changePasswordData.password_confirmation"/>
    </div>


</form>
<div class="clear-both"></div>
<div class="profile-border-box">
    <div class="profil-border"></div>
</div>
<div class="save-btn">
    <input type="submit" class="fmlreg fz25" ng-click="changePassword()" form="changePassword" value="Save"/>
</div>
