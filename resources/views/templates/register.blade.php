

@include('templates/nav')
<div class="modal-header">
    <h3 class="modal-title fz40">Registration</h3>
</div>
<div class="register">
    <div class="package-tab">
    <uib-tabset active="activeForm">
        <uib-tab index="0" heading="Caterer" class="w50">
            @include('templates/caterer/auth/register')
        </uib-tab>
        <uib-tab index="1" heading="User" class="w50">
            @include('templates/user/auth/register')
        </uib-tab>
    </uib-tabset>
        </div>
</div>


    <link href="/administration/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="/administration/assets/css/style.css" rel="stylesheet" type="text/css"/>

    <link href="/administration/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="/administration/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="/css/select.css" rel="stylesheet" type="text/css"/>


