<!-- Header -->
<header>
    <!-- Header Menu -->
    <nav class="navbar navbar-default" ng-controller="NavigationController">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" ng-href="#/">
                    <img src="../images/logo.png" alt="" class="img-responsive">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a ng-href="/#/">Apero bestellen</a></li>
                    {{--<li ng-class="{'active': link == 'hillfe'}"><a ng-href="/#/">Hilfe</a></li>--}}
                    <li><a ng-href="/#/">Hilfe</a></li>


                    <li ng-if="is_logedin == 1"><a ng-href="/#/" ng-click="logout()">Logout</a></li>

                    <li ng-if="is_logedin == 0"><a ng-href="#/login">Login</a></li>
                    <li ng-if="is_logedin == 0"><a ng-href="#/register">Registrieren</a></li>



                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- End Header Menu -->

</header>
<!-- End Header -->