
<div class="modal-header">
    <h3 class="modal-title">Registration</h3>
</div>
<div class="modal-body">
    <!--    <ul>-->
    <!--        <li ng-repeat="item in items">-->
    <!--            <a href="#" ng-click="$event.preventDefault(); selected.item = item"></a>-->
    <!--        </li>-->
    <!--    </ul>-->
    <!--    Selected: <b></b>-->

    <uib-tabset active="active">
        <uib-tab index="0" heading="User">
            @include ('templates/auth/forms/user_reg',['userType' => 'user'])
        </uib-tab>
        <uib-tab index="1" heading="Caterer">
            @include ('templates/auth/forms/caterer_reg',['userType' => 'caterer'])
        </uib-tab>
    </uib-tabset>
</div>
<div class="modal-footer">
    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
</div>