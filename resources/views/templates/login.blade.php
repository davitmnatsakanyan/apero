
<div class="modal-header">
    <h3 class="modal-title">Login</h3>
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
            <h3>Login as User</h3>
            @include('templates/auth/forms/login',['userType' => 'user'])
        </uib-tab>
        <uib-tab index="1" heading="Caterer">
            <h3>Login as Caterer</h3>
            @include ('templates/auth/forms/login',['userType' => 'caterer'])
        </uib-tab>
    </uib-tabset>

    <a href="{{url('social/facebook_login')}}">Login whit facebook</a>
    <a href="{{url('social/twitter_login')}}">Login whit Twitter</a>
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
</div>
