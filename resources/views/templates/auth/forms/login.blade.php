<form ng-submit="login_submit()">

    <input type="hidden" name="_token" ng-init="data._token='{{ csrf_token() }}'" ng-model="data._token">
    <input type="hidden" name="role" ng-init="data.role='{{ $userType }}'" ng-model="data.role">

    <div class="form-group">
        <input type="email"  name="email" class="form-control" ng-model="data.email" required>
    </div>

    <div class="form-group">
        <input type="password"  name="password" class="form-control" ng-model="data.password" required>
    </div>
    <input type="submit" class="btn btn-default" id="submit" value="Login">
</form>


