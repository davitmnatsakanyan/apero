<div ng-include='"templates/nav.blade.php"'></div>
<div class="modal-header">
    <h3 class="modal-title">Registration</h3>
</div>
<div class="register">
    <div class="package-tab">
    <uib-tabset active="activeForm">
        <uib-tab index="0" heading="Caterer">
            <div ng-include='"templates/caterer/auth/register.blade.php"'></div>
        </uib-tab>
        <uib-tab index="1" heading="User">
            <div ng-include='"templates/user/auth/register.blade.php"'></div>
        </uib-tab>
    </uib-tabset>
        </div>
</div>

