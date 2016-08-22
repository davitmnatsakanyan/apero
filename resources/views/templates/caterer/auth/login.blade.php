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
                    <div ng-if="caterer_error_msg == 1" class="alert alert-danger"><button class="close" data-dismiss="alert"></button><% caterer_error_msg_text %></div>
                    <form action="#" class="form-horizontal" id="submit_form" ng-submit="login_submit()">
                        {{ csrf_field() }}
                        <input type="hidden" name="role" ng-init="data.role='caterer'" ng-model="data.role">
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
                                <span class="error"><% caterer_error.email[0] %></span>
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
                                <span class="error"><% caterer_error.password[0] %></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5">
                                <input type="submit" class="btn green button-submit" value="Log In" >
                                <input type="button" class="btn green button-submit" value="Forgot password?" ng-click="open('sm','caterer')"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



