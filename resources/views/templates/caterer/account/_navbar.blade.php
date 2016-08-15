<div class="col-sm-5 col-md-4 cater-left-box">

        <div flow-init="{
        target: 'caterer/settings/uploadFile', singleFile: true, testChunks: true,
        query: { '_token':  '{{ csrf_token() }}', 'path': 'images\\caterers'}
        }"
        flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
        flow-files-submitted="$flow.upload( $files, $event, $flow )"
        flow-file-success="setFileName($flow.files)">
            <input type="file" flow-btn name="avatar" class="inputfile" id="catererImage"/>
            <label for="catererImage" ng-if="isActive('/caterer/profile')">
                <div class="inputfile-label">Change Avatar</div>
            </label>
            <div class="cater-pic" ng-hide="$flow.files.length">
                <img class="ithumbnail"  src="../images/caterers/<% caterer.avatar %>"  />
            </div>
            <div class="cater-pic" ng-show="$flow.files.length">
                <img class="ithumbnail" flow-img="$flow.files[0]" />
            </div>
    </div>


    <div class="cater-btn ctbtn1">
        <a ng-href="#/caterer/orders" class="pencil-icon" ng-class="{ active: isActive('/caterer/orders')}">
            <span class="cater-btn-txt">
                 Meine Bestellungen
            </span>
        </a>
    </div><!--end-->

    <div class="cater-btn ctbtn2">
        <a ng-href="#/caterer/products" class="card-icon" ng-class="{ active: isActive('/caterer/products')}">
            <span class="cater-btn-txt">
                 Meine Produkte
            </span>
        </a>
    </div><!--end-->

    <div class="cater-btn ctbtn2">
        <a ng-href="#/caterer/packages" class="card-icon" ng-class="{ active: isActive('/caterer/packages')}">
            <span class="cater-btn-txt">
                 Meine Package
            </span>
        </a>
    </div><!--end-->

    <div class="cater-btn ctbtn3">
        <a ng-href="#/caterer/profile" class="man-icon" ng-class="{ active: isActive('/caterer/profile')}">
            <span class="cater-btn-txt">
                 Meine Profil
            </span>
        </a>
    </div><!--end-->
    <div class="buttons">

        <ul class="list-inline pull-right no-padding">
            <li>
                <a ng-href="/#/" ng-controller="NavigationController" ng-click="logout()">
                <button class="logout">
                    <span>
                        <i class="fa fa-sign-out ff" aria-hidden="true"></i>
                    </span>
                    Logout
                </button>
                    </a>
            </li>
            <li>
                <button class="hilife">
                    <span>
                        <i class="fa fa-exclamation-circle nn" aria-hidden="true"></i>
                    </span>
                    Hilife
                </button>
            </li>
        </ul>
    </div>

</div>