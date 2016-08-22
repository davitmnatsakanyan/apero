<div ng-include='"templates/nav.blade.php"'></div>
<div class="modal-header">
    <h3 class="modal-title fz40">Login</h3>
</div>
<div class="register package-tab">
    <uib-tabset active="activeForm">
        <uib-tab index="0" heading="Caterer" class="w50">
            <div class="mt20">
            <div ng-include='"templates/caterer/auth/login.blade.php"'></div>
            </div>
        </uib-tab>
        <uib-tab index="1" heading="User" class="w50">
            <div class="mt20">
            <div ng-include='"templates/user/auth/login.blade.php"'></div>
                </div>
        </uib-tab>
    </uib-tabset>
</div>

<div ng-include='"templates/modals/passwordResetEmail.blade.php"'></div>



<link href="/administration/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="/administration/assets/css/style.css" rel="stylesheet" type="text/css"/>

<link href="/administration/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="/administration/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="/css/select.css" rel="stylesheet" type="text/css"/>

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

