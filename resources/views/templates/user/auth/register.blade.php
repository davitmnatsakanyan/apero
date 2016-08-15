
<!-- BEGIN BODY -->

<div class="clearfix" >
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container" ng-controller="AuthController">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <h3 class="block">Provide your personal details</h3>
                <div class="col-md-12">
                    <form action="#" class="form-horizontal" id="submit_form" ng-submit="reg_submit()">

                        <div class="alert alert-danger display-none">
                            <button class="close" data-dismiss="alert"></button>
                            You have some form errors. Please check below.
                        </div>
                        <div class="alert alert-success display-none">
                            <button class="close" data-dismiss="alert"></button>
                            Your form validation is successful!
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="role" ng-init="data.role='user'" ng-model="data.role">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-5">Name
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="name" ng-model="data.name" />
                                    <span class="help-block">
                                         Provide your name
                                    </span>
                                    <span class="error"><% user_error.name[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Title
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="title" ng-model="data.title" />
                                    <span class="help-block">
                                         Provide your title
                                    </span>
                                    <span class="error"><% user_error.title[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Address
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="address" ng-model="data.address" />
                                    <span class="help-block">
                                         Provide your address.
                                    </span>
                                    <span class="error"><% user_error.address[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Pobox
                                <span class="required">

                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="pobox" ng-model="data.pobox" />
                                    <span class="help-block">
                                         Provide your pobox
                                    </span>
                                    <span class="error"><% user_error.pobox[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Zip
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <select class="zip form-control" ng-options="item.zip for  item in zip_codes"  ng-model="data.zip" >
                                    </select>
                                        <span class="help-block">
                                         Provide your zip
                                    </span>
                                    <span class="error"><% user_error.zip[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">City
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="city" ng-model="data.city" />
                                    <span class="help-block">
                                         Provide your city
                                    </span>
                                    <span class="error"><% user_error.city[0] %></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-5">Country</label>
                                <div class="col-md-7">
                                    <ui-select ng-model="selectedCountry"  class="form-control" on-select="selectCountry($select.selected, $model)" name ="country">
                                        <ui-select-match plaseholder="Select country"><% $select.selected.name %></ui-select-match>
                                        <ui-select-choices repeat="country in countries track by country .id">
                                            <% country .name %>
                                        </ui-select-choices>
                                    </ui-select>
                                    <span class="help-block">
                                         Provide your Country
                                    </span>
                                    <span class="error"><% user_error.country[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Email
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email" ng-model="data.email" />
                                    <span class="help-block">
                                         Provide your email
                                    </span>
                                    <span class="error"><% user_error.email[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Password
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="password" ng-model="data.password" id="submit_form_password" />
                                    <span class="help-block">
                                         Provide your password
                                    </span>
                                    <span class="error"><% user_error.password[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Confirm password
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="password_confirmation" ng-model="data.password_confirmation" />
                                    <span class="help-block">
                                        Confirm password
                                    </span>
                                    <span class="error"><% user_error.password_confirmation[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Phone
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="phone" ng-model="data.phone" />
                                    <span class="help-block">
                                         Provide your phone
                                    </span>
                                    <span class="error"><% user_error.phone[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Mobile
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="mobile" ng-model="data.mobile" />
                                    <span class="help-block">
                                         Provide your mobile
                                    </span>
                                    <span class="error"><% user_error.mobile[0] %></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Fax
                                <span class="required">
                                     *
                                </span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="fax" ng-model="data.fax" />
                                    <span class="help-block">
                                         Provide your fax
                                    </span>
                                    <span class="error"><% user_error.fax[0] %></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3 ">
                                <input type="submit" value="Register" class="btn green button-submit">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
</div>




