<div class="clearfix" >
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container" ng-controller="AuthController">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <form action="#" class="form-horizontal" id="submit_form" ng-submit="">
                        <div class="form-group">
                            <label class="control-label col-md-2">Email
                                                        <span class="required">
                                                             *
                                                        </span>
                            </label>
                            <div class="col-md-5">
                                <input type="email" class="form-control" name="email" ng-model="data.email" />
                                                            <span class="help-block">
                                                                 Provide your email
                                                            </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Password
                                                        <span class="required">
                                                             *
                                                        </span>
                            </label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" name="password" ng-model="data.password" id="submit_form_password" />
                                                            <span class="help-block">
                                                                 Provide your password
                                                            </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>