var app = angular.module('app', [
    'ngRoute', 'ngAnimate', 'ngSanitize', 'ngTouch', 'ui.bootstrap'
]);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/caterer/account', {
            templateUrl: 'templates/caterer/account/index.blade.php',
            controller: 'CatererController'
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