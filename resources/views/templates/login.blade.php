<div ng-include='"templates/nav.blade.php"'></div>
<div class="modal-header">
    <h3 class="modal-title">Login</h3>
</div>
<div class="register">
    <uib-tabset active="activeForm">
        <uib-tab index="0" heading="Caterer">
            <div ng-include='"templates/caterer/auth/login.blade.php"'></div>
        </uib-tab>
        <uib-tab index="1" heading="User">
            Some Tab Content
        </uib-tab>
    </uib-tabset>
</div>


