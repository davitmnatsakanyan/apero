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
                            <div class="profil-title">
                                <h2 class="fz28 fmlreg cg1">Meine Profil</h2>
                            </div>

                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs profil-box-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                            Catering - Company
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                            Catering - Company Manager
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home profile-tabs">

                                        <div class="profil-form fl">
                                            <form action="#" method="post">
                                                <div class="info-box">
                                                    <label for="title" class="title fmlbold fz17">Title</label>
                                                    <input type="text" placeholder="Arnold" class="text fmlreg fz13" id="title"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="prename" class="title fmlbold fz17">Prename</label>
                                                    <input type="text" placeholder="Arnold" class="text fmlreg fz13" id="prename"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="name" class="title fmlbold fz17">Name</label>
                                                    <input type="text" placeholder="Arnold" class="text fmlreg fz13" id="name"/>
                                                </div><!--end-->

                                            </form>
                                        </div><!--end-->

                                        <div class="profil-form fl">
                                            <form action="#" method="post">
                                                <div class="info-box">
                                                    <label for="mobil" class="title fmlbold fz17">Mobil</label>
                                                    <input type="text" placeholder="Arnold" class="text fmlreg fz13" id="mobil"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="phone" class="title fmlbold fz17">Phone</label>
                                                    <input type="text" placeholder="Arnold" class="text fmlreg fz13" id="phone"/>
                                                </div><!--end-->

                                                <div class="info-box">
                                                    <label for="email" class="title fmlbold fz17">E-mail</label>
                                                    <input type="text" placeholder="Arnold" class="text fmlreg fz13" id="email"/>
                                                </div><!--end-->

                                            </form>
                                        </div><!--end-->
                                        <div class="clear-both"></div>
                                        <div class="profile-border-box">
                                            <div class="profil-border"></div>
                                        </div>
                                        <div class="save-btn">
                                            <input type="submit" value="Save" class="fmlreg fz25"/>
                                        </div>

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        ...
                                    </div>
                                </div>

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
