<div ng-include='"templates/nav.blade.php"'></div>
<!-- Content -->
<main>
    <div class="top-banner3">
        <div class="container-fluid wrapper920 caret-inner-box">
            <div class="row">
                <div class="col-sm-12 hh">
                    <div class="inner-cater-txt">
                        <p>Hello  “Catering - Company”</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="inner-cater">

                        <div ng-include='"templates/caterer/account/_navbar.blade.php"'></div>

                        <div class="col-sm-7 col-md-8">


                            <div>

                                <uib-tabset active="activeJustified" justified="true">
                                    <uib-tab index="0" heading="Common information">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="home profile-tabs">
                                                <form action="#" method="post">
                                                <div class="profil-form fl">
                                                        <div class="info-box">
                                                            <label for="company" class="title fmlbold fz17">Company</label>
                                                            <input type="text" class="text fmlreg fz13" id="company" ng-model="caterer.company"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="address" class="title fmlbold fz17">Address</label>
                                                            <input type="text"  class="text fmlreg fz13" id="address" ng-model="caterer.address"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="pobox" class="title fmlbold fz17">Pobox</label>
                                                            <input type="text" class="text fmlreg fz13" id="pobox" ng-model="caterer.pobox"/>
                                                        </div><!--end-->

                                                    <div class="info-box">
                                                        <label for="zip" class="title fmlbold fz17">Zip</label>
                                                        <input type="text" class="text fmlreg fz13" id="zip" ng-model="caterer.zip"/>
                                                    </div><!--end-->

                                                    <div class="info-box">
                                                        <label for="products_origin" class="title fmlbold fz17">Products Origin</label>
                                                        <input type="text" class="text fmlreg fz13" id="zip" ng-model="caterer.products_origin"/>
                                                    </div><!--end-->


                                                </div><!--end-->

                                                <div class="profil-form fl">
                                                        <div class="info-box">
                                                            <label for="city" class="title fmlbold fz17">City</label>
                                                            <input type="text" class="text fmlreg fz13" id="city" ng-model="caterer.city"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="phone" class="title fmlbold fz17">Phone</label>
                                                            <input type="text" class="text fmlreg fz13" id="phone" ng-model="caterer.phone"/>
                                                        </div><!--end-->

                                                        <div class="info-box">
                                                            <label for="email" class="title fmlbold fz17">E-mail</label>
                                                            <input type="email" class="text fmlreg fz13" id="email" ng-model="caterer.email"/>
                                                        </div><!--end-->

                                                    <div class="info-box">
                                                        <label for="country" class="title fmlbold fz17">Country</label>
                                                        <input type="text"  class="text fmlreg fz13" id="country" ng-model="caterer.country"/>
                                                    </div><!--end-->

                                                    <div class="info-box">
                                                        <label for="description" class="title fmlbold fz17">Description</label>
                                                        <input type="textarea"  class="text fmlreg fz13" id="description" ng-model="caterer.description"/>
                                                    </div><!--end-->


                                                </div><!--end-->
                                                </form>
                                                <div class="clear-both"></div>
                                                <div class="profile-border-box">
                                                    <div class="profil-border"></div>
                                                </div>

                                                {{--<button ng-click="registerInStripe()">Button</button>--}}
                                                <div class="save-btn">
                                                    <input type="submit" value="Save" class="fmlreg fz25"/>
                                                </div>

                                            </div>
                                        </div>
                                    </uib-tab>
                                    <uib-tab index="1" heading="Contact person">
                                        <form action="#" method="post">
                                            <div class="profil-form fl">
                                                <div class="info-box">
                                                    <label for="cp_title" class="title fmlbold fz17">Title</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_title" ng-model="contact_person.title"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_prename" class="title fmlbold fz17">Prename</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_prename" ng-model="contact_person.prename"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_name" class="title fmlbold fz17">Name</label>
                                                    <input type="text"  class="text fmlreg fz13" id="cp_name" ng-model="contact_person.name"/>
                                                </div><!--end-->

                                            </div><!--end-->

                                            <div class="profil-form fl">
                                                <div class="info-box">
                                                    <label for="cp_mobile" class="title fmlbold fz17">Mobil</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_mobile" ng-model="contact_person.mobile"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_phone" class="title fmlbold fz17">Phone</label>
                                                    <input type="text" class="text fmlreg fz13" id="cp_phone" ng-model="contact_person.phone"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="cp_email" class="title fmlbold fz17">E-mail</label>
                                                    <input type="email" class="text fmlreg fz13" id="cp_email"  ng-model="contact_person.email"/>
                                                </div><!--end-->

                                            </div><!--end-->
                                        </form>
                                        <div class="clear-both"></div>
                                        <div class="profile-border-box">
                                            <div class="profil-border"></div>
                                        </div>
                                        <div class="save-btn">
                                            <input type="submit" value="Save" class="fmlreg fz25" ng-click="updateContactPerson()"/>
                                        </div>
                                    </uib-tab>
                                    <uib-tab index="2" heading="Delivery Area">
                                        <div ng-include='"templates/caterer/account/items/deliveryArea.blade.php"'></div>
                                    </uib-tab>
                                    <uib-tab index="3" heading="Kitchens">Long Labeled Justified content</uib-tab>
                                    <uib-tab index="4" heading="Cooking Time">
                                        <div ng-include='"templates/caterer/account/items/cookingTime.blade.php"'></div>
                                    </uib-tab>
                                </uib-tabset>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End Content -->
<div ng-include='"templates/footer.blade.php"'></div>
