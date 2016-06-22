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
    <link href="/css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <ng-view></ng-view>

    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/bower_components/moment/moment.js"></script>
    <script src="/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

    <script src="/bower_components/angular/angular.js"></script>
    <script src="/bower_components/angular-animate/angular-animate.js"></script>
    <script src="/bower_components/angular-route/angular-route.js"></script>
    <script src="/bower_components/angular-resource/angular-resource.js"></script>
    <script src="/bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="/bower_components/angular-touch/angular-touch.js"></script>
    <script src="/bower_components/angular-ui-bootstrap/ui-bootstrap-tpls-1.3.3.js"></script>

    <script src="/js/app.js"></script>
    <script src="/js/controllers/NavigationController.js"></script>
    <script src="/js/controllers/AuthController.js"></script>
    <script src="/js/controllers/HomeController.js"></script>
    <script src="/js/controllers/HilfeController.js"></script>
    <script src="/js/controllers/CatererController.js"></script>
    <script src="/js/controllers/BestellenController.js"></script>

    <script src="/js/directives/inputText.js"></script>
</body>
</html>