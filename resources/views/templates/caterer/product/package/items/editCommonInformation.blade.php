
<form action="#" method="post" id="editCommon">

    <div flow-init
         {{--flow-files-submitted="$flow.upload()"--}}
         flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
         flow-file-success="$file.msg = $message">

        <input type="file" flow-btn name="avatar"/>

        <div class="cater-pic caterer-pic-width" ng-hide="$flow.files.length">
            <img class="ithumbnail cater-pic-width"  src="../images/restaurant-pic.png" />
        </div>
        <div class="cater-pic caterer-pic-width" ng-show="$flow.files.length">
            <img class="ithumbnail cater-pic-width" flow-img="$flow.files[0]" />
        </div>

    </div>
    <div class="profil-form fl">
        <div class="info-box">
            <label for="company" class="title fmlbold fz17">Name</label>
            <input type="text" class="text fmlreg fz13" id="company" ng-model="package.name"/>
        </div><!--end-->
    </div><!--end-->

    <div class="profil-form fl">
        <div class="info-box">
            <label for="city" class="title fmlbold fz17">Price</label>
            <input type="text" class="text fmlreg fz13" id="city" ng-model="package.price"/>
        </div><!--end-->
    </div><!--end-->
</form>
<div class="clear-both"></div>
<div class="profile-border-box">
    <div class="profil-border"></div>
</div>
<div class="save-btn">
    <input form="editCommon" type="submit" value="Save" class="fmlreg fz25" ng-click="updateCommmon()"/>
</div>