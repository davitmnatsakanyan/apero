<div class="modal-header">
    <h3 class="modal-title">Login</h3>
</div>
<div class="modal-body">
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


