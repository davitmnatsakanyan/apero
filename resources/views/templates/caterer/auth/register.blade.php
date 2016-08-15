
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
                <div class="col-md-12">
                    <div class="portlet box blue" id="form_wizard_1">
                        <div class="portlet-title">
                        </div>
                        <div class="portlet-body form">
                            <form action="#" class="form-horizontal" id="submit_form" ng-submit="reg_submit()">
                                <div class="form-wizard">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a href="#tab1" data-toggle="tab" class="step">
													<span class="number">
														 1
													</span>
													<span class="desc">
														<i class="fa fa-check"></i> Register as caterer
													</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" data-toggle="tab" class="step">
													<span class="number">
														 2
													</span>
													<span class="desc">
														<i class="fa fa-check"></i> Caterer details
													</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab3" data-toggle="tab" class="step active">
													<span class="number">
														 3
													</span>
													<span class="desc">
														<i class="fa fa-check"></i> Overview
													</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success">
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="alert alert-danger display-none">
                                                <button class="close" data-dismiss="alert"></button>
                                                You have some form errors. Please check below.
                                            </div>
                                            <div class="alert alert-success display-none">
                                                <button class="close" data-dismiss="alert"></button>
                                                Your form validation is successful!
                                            </div>
                                            <div class="tab-pane active" id="tab1">
                                                <div class="col-md-6">
                                                    <h3 class="block">Provide your caterer details</h3>
                                                    <input type="hidden" name="role" ng-init="data.role='caterer'" ng-model="data.role">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Company
                                                        <span class="required">
                                                             *
                                                        </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="company" ng-model="data.company" />
                                                            <span class="help-block">
                                                                 Provide your company
                                                            </span>
                                                            <span class="error"><% caterer_error.company[0] %></span>
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
                                                                 Confirm your pobox
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Zip
                                                        <span class="required">
                                                             *
                                                        </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <select class="zip form-control" ng-options="item.zip for  item in zip_codes"  ng-model="data.zip" ></select>
                                                                <span class="help-block">
                                                                 Provide your zip
                                                            </span>
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
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Country
                                                        <span class="required">
                                                             *
                                                        </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <ui-select ng-model="selectedCountry"  class="form-control" on-select="selectCountry($select.selected, $model)" name ="country">
                                                                <ui-select-match plaseholder="Select country"><% $select.selected.name %></ui-select-match>
                                                                <ui-select-choices repeat="country in countries track by country .id">
                                                                    <% country .name %>
                                                                </ui-select-choices>
                                                            </ui-select>
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
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Confirm password
                                                        <span class="required">
                                                             *
                                                        </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="password" class="form-control" name="rpassword" ng-model="data.rpassword" />
                                                            <span class="help-block">

                                                            </span>
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
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="control-label col-md-5">Description
													<span class="required">

													</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <textarea class="form-control" name="description" ng-model="data.description" ></textarea>
														<span class="help-block">
															 Provide your description
														</span>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3 class="block">Contact person</h3>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Title
                                                    <span class="required">
                                                         *
                                                    </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="person_title" ng-model="data.person_title" />
                                                        <span class="help-block">

                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Prename
                                                    <span class="required">
                                                         *
                                                    </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="person_prename" ng-model="data.person_prename" />
                                                        <span class="help-block">

                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Name
                                                    <span class="required">
                                                         *
                                                    </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="person_name" ng-model="data.person_name" />
                                                        <span class="help-block">

                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Mobile
                                                    <span class="required">
                                                         *
                                                    </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="person_mobile" ng-model="data.person_mobile" />
                                                        <span class="help-block">

                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Phone
                                                    <span class="required">
                                                         *
                                                    </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" name="person_phone" ng-model="data.person_phone" />
                                                        <span class="help-block">

                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-5">Email
                                                    <span class="required">
                                                         *
                                                    </span>
                                                        </label>
                                                        <div class="col-md-7">
                                                            <input type="email" class="form-control" name="person_email" ng-model="data.person_email" />
                                                        <span class="help-block">

                                                        </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <h3 class="block">Select caterer details</h3>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Food category
													<span class="required">
														 *
													</span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select name="kitchen[]" class="kitchen js-states form-control" ng-model="data.kitchen"
                                                                ng-options="item as item.name for item in categories"  multiple="multiple"  >
                                                        </select>
														<span class="help-block">

														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Delivery area
													<span class="required">
														 *
													</span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <select name="delivery_area[]" class="delivery_area js-states form-control" ng-model="data.delivery_area"
                                                                ng-options="item as item.text for item in zip_codes" multiple="multiple" >
                                                            {{--<option ng-repeat="item in zip_codes" ng-selected="item.selected"  value="<% item.id %>"><% item.text %></option>--}}
                                                        </select>
														<span class="help-block">

														</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Products origin
													<span class="required">
														 *
													</span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="product_origin" ng-model="data.product_origin" >
														<span class="help-block">

														</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <div class="col-md-6">
                                                    <h3 class="block">Caterer details</h3>
                                                    <p>Company : <%  data.company %></p>
                                                    <p>Address : <%  data.address %></p>
                                                    <p>Pobox : <%  data.pobox %></p>
                                                    <p>Zip : <%  data.zip %></p>
                                                    <p>Zip : <%  data.zip %></p>
                                                    <p>City : <%  data.city %></p>
                                                    <p>Country : <%  data.country %></p>
                                                    <p>Email : <%  data.email %></p>
                                                    <p>Phone : <%  data.phone %></p>
                                                    <p>Phone : <%  data.phone %></p>
                                                    <p>Fax : <%  data.fax %></p>
                                                    <p>Desctiption : <%  data.description %></p>
                                                    <p>Food category : <span ng-repeat="item in data.kitchen"><% item.name %>, </span></p>
                                                    <p>Delivery area : <span ng-repeat="item in data.delivery_area"><% item.text %>, </span></p></p>
                                                    <p>Products origin : <%  data.product_origin %></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3 class="block">Contact person</h3>
                                                    <p>Title: <% data.person_title %></p>
                                                    <p>Prename: <% data.person_prename %></p>
                                                    <p>Name: <% data.person_name %></p>
                                                    <p>Mobile: <% data.person_mobile %></p>
                                                    <p>Phone: <% data.person_phone %></p>
                                                    <p>Email: <% data.person_email %></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <a href="javascript:;" class="btn default button-previous">
                                                        <i class="m-icon-swapleft"></i> Back
                                                    </a>
                                                    <a href="javascript:;" class="btn blue button-next">
                                                        Continue <i class="m-icon-swapright m-icon-white"></i>
                                                    </a>
                                                    <input type="submit" value="Submit" class="btn green button-submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/administration/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="/administration/assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="/administration/assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/administration/assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/administration/assets/scripts/core/app.js"></script>
<script src="/administration/assets/scripts/custom/form-wizard.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        FormWizard.init();

        $("select").select2();

    });
</script>
<!-- END JAVASCRIPTS -->

