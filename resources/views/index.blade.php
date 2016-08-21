<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>Apero</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="/images/logo.png">
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap-theme.min.css" media="screen">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css" media="screen">

    <link rel="stylesheet" href="/css/datetimepicker.css"/>
    {{--<link href="/css/bootstrap-datepicker.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://npmcdn.com/angular-toastr/dist/angular-toastr.css"/>
    <link rel="stylesheet" href="/css/style.css">
    {{--<link rel="stylesheet" href="/css/custom.css">--}}


    {{--<!-- BEGIN GLOBAL MANDATORY STYLES -->--}}
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>

    {{--<link href="/administration/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>--}}

    {{--<!-- END GLOBAL MANDATORY STYLES -->--}}
    {{--<!-- BEGIN PAGE LEVEL STYLES -->--}}
    <link rel="stylesheet" type="text/css" href="/administration/assets/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="/administration/assets/plugins/select2/select2-metronic.css"/>
    {{--<!-- END PAGE LEVEL SCRIPTS -->--}}
    {{--<!-- BEGIN THEME STYLES -->--}}

    {{-- admin css--}}

    {{--<link href="/administration/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="/administration/assets/css/style.css" rel="stylesheet" type="text/css"/>--}}

    {{--<link href="/administration/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="/administration/assets/css/plugins.css" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="/css/custom.css" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="/css/select.css" rel="stylesheet" type="text/css"/>--}}

    {{-- end admin css --}}

    {{--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css">--}}
    <script>
        var BASE_URL = '{{ url('/') }}';
    </script>
    <!-- END THEME STYLES -->
</head>
<body>

<ng-view></ng-view>

<script src="/bower_components/jquery/dist/jquery.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="/bower_components/moment/moment.js"></script>
{{--<script src="/js/bootstrap-datetimepicker.js" type="text/javascript"></script>--}}

<script src="/bower_components/angular/angular.js"></script>
<script src="/bower_components/angular-route/angular-route.js"></script>
<script src="/bower_components/angular-animate/angular-animate.js"></script>

<script src="/bower_components/angular-resource/angular-resource.js"></script>
<script src="/bower_components/angular-sanitize/angular-sanitize.js"></script>
<script src="/bower_components/angular-touch/angular-touch.js"></script>
<script src="/bower_components/angular-ui-bootstrap/ui-bootstrap-tpls-1.3.3.js"></script>
<script src="/bower_components/angular-payments/lib/angular-payments.js"> </script>
<script type="text/javascript" src="/js/datetimepicker.js"></script>
<script type="text/javascript" src="/js/datetimepicker.templates.js"></script>

<script src="/js/angular-modal-service.min.js"></script>
<script src="https://npmcdn.com/angular-toastr/dist/angular-toastr.tpls.js"></script>
<script src="/js/ng-flow-standalone.min.js"></script>
<script src="/js/select.js"></script>


{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>--}}

<script src="/js/app.js"></script>


<!-- start controllers -->
<script src="/js/services/AuthService.js"></script>
<script src="/js/services/sharedProperties.js"></script>
<script src="/js/controllers/NavigationController.js"></script>
<script src="/js/controllers/AuthController.js"></script>
<script src="/js/controllers/HomeController.js"></script>
<script src="/js/controllers/SearchController.js"></script>
<script src="/js/controllers/CatererProfileController.js"></script>
<script src="/js/controllers/StripeModalInstanceController.js"></script>
<script src="/js/controllers/CatererOrdersController.js"></script>
<script src="/js/controllers/CatererProductsController.js"></script>
<script src="/js/controllers/CatererController.js"></script>
<script src="/js/controllers/OrderController.js"></script>
<script src="/js/controllers/CartController.js"></script>
<script src="/js/controllers/SubPrdModalController.js"></script>
<script src="/js/controllers/CustomPrdModalController.js"></script>
<script src="/js/controllers/UserProfileController.js"></script>
<script src="/js/controllers/UserOrdersController.js"></script>
<script src="/js/controllers/CatererPackageController.js"></script>
<script src="/js/controllers/EditProductController.js"></script>
<script src="/js/controllers/ModalInstanceController.js"></script>
<script src="/js/controllers/CookingTimeModalInstanceController.js"></script>
<script src="/js/controllers/UploadImageModalInstanceController.js"></script>
<script src="/js/controllers/SubproductModalInstanceController.js"></script>


<!-- end controllers -->


<script src="/js/directives/inputText.js"></script>

<script src="/js/filters/homeFilter.js"></script>

<script src="/js/models/CatererAccountModel.js"></script>
<script src="/js/models/CatererProductModel.js"></script>
<script src="/js/models/CatererModel.js"></script>
<script src="/js/models/SearchModel.js"></script>
<script src="/js/models/UserModel.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb-bWFpEeZ2AN5uAlZQG2iY8n5GhQOkE4">
</script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
{{--<script type="text/javascript">--}}
{{--Stripe.setPublishableKey('pk_test_RRDcRey63aipkR9UbaPDPRTo');--}}
{{--</script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $('select').select2();
</script>
@yield('scrips')
</body>
</html>