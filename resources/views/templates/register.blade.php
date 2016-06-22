
<div class="modal-header">
    <h3 class="modal-title">Registration</h3>
</div>
<div class="modal-body">
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
</div>