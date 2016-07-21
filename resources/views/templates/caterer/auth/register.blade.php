
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
                                                            <select name="country" id="country_list"  class="form-control" ng-model="data.country" >
                                                                <option value=""></option>
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                                <option value="AQ">Antarctica</option>
                                                                <option value="AR">Argentina</option>
                                                                <option value="AM">Armenia</option>
                                                                <option value="AW">Aruba</option>
                                                                <option value="AU">Australia</option>
                                                                <option value="AT">Austria</option>
                                                                <option value="AZ">Azerbaijan</option>
                                                                <option value="BS">Bahamas</option>
                                                                <option value="BH">Bahrain</option>
                                                                <option value="BD">Bangladesh</option>
                                                                <option value="BB">Barbados</option>
                                                                <option value="BY">Belarus</option>
                                                                <option value="BE">Belgium</option>
                                                                <option value="BZ">Belize</option>
                                                                <option value="BJ">Benin</option>
                                                                <option value="BM">Bermuda</option>
                                                                <option value="BT">Bhutan</option>
                                                                <option value="BO">Bolivia</option>
                                                                <option value="BA">Bosnia and Herzegowina</option>
                                                                <option value="BW">Botswana</option>
                                                                <option value="BV">Bouvet Island</option>
                                                                <option value="BR">Brazil</option>
                                                                <option value="IO">British Indian Ocean Territory</option>
                                                                <option value="BN">Brunei Darussalam</option>
                                                                <option value="BG">Bulgaria</option>
                                                                <option value="BF">Burkina Faso</option>
                                                                <option value="BI">Burundi</option>
                                                                <option value="KH">Cambodia</option>
                                                                <option value="CM">Cameroon</option>
                                                                <option value="CA">Canada</option>
                                                                <option value="CV">Cape Verde</option>
                                                                <option value="KY">Cayman Islands</option>
                                                                <option value="CF">Central African Republic</option>
                                                                <option value="TD">Chad</option>
                                                                <option value="CL">Chile</option>
                                                                <option value="CN">China</option>
                                                                <option value="CX">Christmas Island</option>
                                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                                <option value="CO">Colombia</option>
                                                                <option value="KM">Comoros</option>
                                                                <option value="CG">Congo</option>
                                                                <option value="CD">Congo, the Democratic Republic of the</option>
                                                                <option value="CK">Cook Islands</option>
                                                                <option value="CR">Costa Rica</option>
                                                                <option value="CI">Cote d'Ivoire</option>
                                                                <option value="HR">Croatia (Hrvatska)</option>
                                                                <option value="CU">Cuba</option>
                                                                <option value="CY">Cyprus</option>
                                                                <option value="CZ">Czech Republic</option>
                                                                <option value="DK">Denmark</option>
                                                                <option value="DJ">Djibouti</option>
                                                                <option value="DM">Dominica</option>
                                                                <option value="DO">Dominican Republic</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="EG">Egypt</option>
                                                                <option value="SV">El Salvador</option>
                                                                <option value="GQ">Equatorial Guinea</option>
                                                                <option value="ER">Eritrea</option>
                                                                <option value="EE">Estonia</option>
                                                                <option value="ET">Ethiopia</option>
                                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                                <option value="FO">Faroe Islands</option>
                                                                <option value="FJ">Fiji</option>
                                                                <option value="FI">Finland</option>
                                                                <option value="FR">France</option>
                                                                <option value="GF">French Guiana</option>
                                                                <option value="PF">French Polynesia</option>
                                                                <option value="TF">French Southern Territories</option>
                                                                <option value="GA">Gabon</option>
                                                                <option value="GM">Gambia</option>
                                                                <option value="GE">Georgia</option>
                                                                <option value="DE">Germany</option>
                                                                <option value="GH">Ghana</option>
                                                                <option value="GI">Gibraltar</option>
                                                                <option value="GR">Greece</option>
                                                                <option value="GL">Greenland</option>
                                                                <option value="GD">Grenada</option>
                                                                <option value="GP">Guadeloupe</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="GT">Guatemala</option>
                                                                <option value="GN">Guinea</option>
                                                                <option value="GW">Guinea-Bissau</option>
                                                                <option value="GY">Guyana</option>
                                                                <option value="HT">Haiti</option>
                                                                <option value="HM">Heard and Mc Donald Islands</option>
                                                                <option value="VA">Holy See (Vatican City State)</option>
                                                                <option value="HN">Honduras</option>
                                                                <option value="HK">Hong Kong</option>
                                                                <option value="HU">Hungary</option>
                                                                <option value="IS">Iceland</option>
                                                                <option value="IN">India</option>
                                                                <option value="ID">Indonesia</option>
                                                                <option value="IR">Iran (Islamic Republic of)</option>
                                                                <option value="IQ">Iraq</option>
                                                                <option value="IE">Ireland</option>
                                                                <option value="IL">Israel</option>
                                                                <option value="IT">Italy</option>
                                                                <option value="JM">Jamaica</option>
                                                                <option value="JP">Japan</option>
                                                                <option value="JO">Jordan</option>
                                                                <option value="KZ">Kazakhstan</option>
                                                                <option value="KE">Kenya</option>
                                                                <option value="KI">Kiribati</option>
                                                                <option value="KP">Korea, Democratic People's Republic of</option>
                                                                <option value="KR">Korea, Republic of</option>
                                                                <option value="KW">Kuwait</option>
                                                                <option value="KG">Kyrgyzstan</option>
                                                                <option value="LA">Lao People's Democratic Republic</option>
                                                                <option value="LV">Latvia</option>
                                                                <option value="LB">Lebanon</option>
                                                                <option value="LS">Lesotho</option>
                                                                <option value="LR">Liberia</option>
                                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lithuania</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MO">Macau</option>
                                                                <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                                                <option value="MG">Madagascar</option>
                                                                <option value="MW">Malawi</option>
                                                                <option value="MY">Malaysia</option>
                                                                <option value="MV">Maldives</option>
                                                                <option value="ML">Mali</option>
                                                                <option value="MT">Malta</option>
                                                                <option value="MH">Marshall Islands</option>
                                                                <option value="MQ">Martinique</option>
                                                                <option value="MR">Mauritania</option>
                                                                <option value="MU">Mauritius</option>
                                                                <option value="YT">Mayotte</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="FM">Micronesia, Federated States of</option>
                                                                <option value="MD">Moldova, Republic of</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="MN">Mongolia</option>
                                                                <option value="MS">Montserrat</option>
                                                                <option value="MA">Morocco</option>
                                                                <option value="MZ">Mozambique</option>
                                                                <option value="MM">Myanmar</option>
                                                                <option value="NA">Namibia</option>
                                                                <option value="NR">Nauru</option>
                                                                <option value="NP">Nepal</option>
                                                                <option value="NL">Netherlands</option>
                                                                <option value="AN">Netherlands Antilles</option>
                                                                <option value="NC">New Caledonia</option>
                                                                <option value="NZ">New Zealand</option>
                                                                <option value="NI">Nicaragua</option>
                                                                <option value="NE">Niger</option>
                                                                <option value="NG">Nigeria</option>
                                                                <option value="NU">Niue</option>
                                                                <option value="NF">Norfolk Island</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="NO">Norway</option>
                                                                <option value="OM">Oman</option>
                                                                <option value="PK">Pakistan</option>
                                                                <option value="PW">Palau</option>
                                                                <option value="PA">Panama</option>
                                                                <option value="PG">Papua New Guinea</option>
                                                                <option value="PY">Paraguay</option>
                                                                <option value="PE">Peru</option>
                                                                <option value="PH">Philippines</option>
                                                                <option value="PN">Pitcairn</option>
                                                                <option value="PL">Poland</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="QA">Qatar</option>
                                                                <option value="RE">Reunion</option>
                                                                <option value="RO">Romania</option>
                                                                <option value="RU">Russian Federation</option>
                                                                <option value="RW">Rwanda</option>
                                                                <option value="KN">Saint Kitts and Nevis</option>
                                                                <option value="LC">Saint LUCIA</option>
                                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                                <option value="WS">Samoa</option>
                                                                <option value="SM">San Marino</option>
                                                                <option value="ST">Sao Tome and Principe</option>
                                                                <option value="SA">Saudi Arabia</option>
                                                                <option value="SN">Senegal</option>
                                                                <option value="SC">Seychelles</option>
                                                                <option value="SL">Sierra Leone</option>
                                                                <option value="SG">Singapore</option>
                                                                <option value="SK">Slovakia (Slovak Republic)</option>
                                                                <option value="SI">Slovenia</option>
                                                                <option value="SB">Solomon Islands</option>
                                                                <option value="SO">Somalia</option>
                                                                <option value="ZA">South Africa</option>
                                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                                <option value="ES">Spain</option>
                                                                <option value="LK">Sri Lanka</option>
                                                                <option value="SH">St. Helena</option>
                                                                <option value="PM">St. Pierre and Miquelon</option>
                                                                <option value="SD">Sudan</option>
                                                                <option value="SR">Suriname</option>
                                                                <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                                                <option value="SZ">Swaziland</option>
                                                                <option value="SE">Sweden</option>
                                                                <option value="CH">Switzerland</option>
                                                                <option value="SY">Syrian Arab Republic</option>
                                                                <option value="TW">Taiwan, Province of China</option>
                                                                <option value="TJ">Tajikistan</option>
                                                                <option value="TZ">Tanzania, United Republic of</option>
                                                                <option value="TH">Thailand</option>
                                                                <option value="TG">Togo</option>
                                                                <option value="TK">Tokelau</option>
                                                                <option value="TO">Tonga</option>
                                                                <option value="TT">Trinidad and Tobago</option>
                                                                <option value="TN">Tunisia</option>
                                                                <option value="TR">Turkey</option>
                                                                <option value="TM">Turkmenistan</option>
                                                                <option value="TC">Turks and Caicos Islands</option>
                                                                <option value="TV">Tuvalu</option>
                                                                <option value="UG">Uganda</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="AE">United Arab Emirates</option>
                                                                <option value="GB">United Kingdom</option>
                                                                <option value="US">United States</option>
                                                                <option value="UM">United States Minor Outlying Islands</option>
                                                                <option value="UY">Uruguay</option>
                                                                <option value="UZ">Uzbekistan</option>
                                                                <option value="VU">Vanuatu</option>
                                                                <option value="VE">Venezuela</option>
                                                                <option value="VN">Viet Nam</option>
                                                                <option value="VG">Virgin Islands (British)</option>
                                                                <option value="VI">Virgin Islands (U.S.)</option>
                                                                <option value="WF">Wallis and Futuna Islands</option>
                                                                <option value="EH">Western Sahara</option>
                                                                <option value="YE">Yemen</option>
                                                                <option value="ZM">Zambia</option>
                                                                <option value="ZW">Zimbabwe</option>
                                                            </select>
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

