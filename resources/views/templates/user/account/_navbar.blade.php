<div class="col-sm-5 col-md-4 cater-left-box">
    <div class="apero-pic">
        <img ng-src="images/apero-pic.png" alt=""/>
    </div>
    <div class="cater-btn ctbtn1">
        <div>
            <a href="#/user/orders" class="pencil-icon" ng-class="{ active: isActive('/user/orders')}">
                <span class="cater-btn-txt">
                     Meine Bestellungen
                </span>
            </a>
        </div>
    </div><!--end-->

    <div class="cater-btn ctbtn3">
        <div>
            <a href="#/user/account" class="man-icon" ng-class="{ active: isActive('/user/account')}">
                <span class="cater-btn-txt">
                     Meine Profil
                </span>
            </a>
        </div>
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
                <a ng-href="#/">
                <button class="hilife">
                    <span>
                        <i class="fa fa-exclamation-circle nn" aria-hidden="true"></i>
                    </span>
                    Hilife
                </button>
                    </a>
            </li>
        </ul>
    </div>


</div>
