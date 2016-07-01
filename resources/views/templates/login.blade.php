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
            <div ng-include='"templates/user/auth/login.blade.php"'></div>
        </uib-tab>
    </uib-tabset>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{--<script type="text/javascript" src="/administration/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>--}}
{{--<script type="text/javascript" src="/administration/assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>--}}
{{--<script type="text/javascript" src="/administration/assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>--}}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/administration/assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{{--<script src="/administration/assets/scripts/core/app.js"></script>--}}
{{--<script src="/administration/assets/scripts/custom/form-wizard.js"></script>--}}

