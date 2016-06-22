var app = angular.module('app', [
    'ngRoute', 'ngAnimate', 'ngSanitize', 'ngTouch', 'ui.bootstrap'
]);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'templates/home.php',
            controller: 'HomeController'
        })
        .when('/hillfe', {
            templateUrl: 'templates/hillfe.php',
            controller: 'HilfeController'
        })
        .when('/caterer', {
            templateUrl: 'templates/caterer.php',
            controller: 'CatererController'
        })
        .when('/bestellen', {
            templateUrl: 'templates/bestellen.php',
            controller: 'BestellenController'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);