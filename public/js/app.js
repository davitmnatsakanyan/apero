var app = angular.module('app', [
    'ngRoute', 'ngAnimate', 'ngSanitize', 'ngTouch', 'ui.bootstrap'
]);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/caterer/logout', {
            templateUrl: '',
            controller: 'AuthController'
        })
        .when('/caterer/login', {
            templateUrl: 'templates/caterer/auth/login.blade.php',
            controller: 'AuthController'
        })
        .when('/caterer/register', {
            templateUrl: 'templates/caterer/auth/register.blade.php',
            controller: 'AuthController'
        })
        .when('/caterer/account', {
            templateUrl: 'templates/caterer/account/index.blade.php',
            controller: 'CatererController',
        })
        .when('/', {
            templateUrl: 'templates/home.blade.php',
            controller: 'HomeController'
        })
        .when('/hillfe', {
            templateUrl: 'templates/hillfe.blade.php',
            controller: 'HilfeController'
        })
        .when('/caterer', {
            templateUrl: 'templates/caterer.blade.php',
            controller: 'CatererController'
        })
        .when('/bestellen', {
            templateUrl: 'templates/bestellen.blade.php',
            controller: 'BestellenController'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);

//app.run(function ($rootScope, $location, $route, AuthService) {
//
//
//})

